<?php

namespace AppBundle\Service\Integration;

use AppBundle\Exception\AppServiceUnavailableException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\TransferStats;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class BaseRestIntegrationService
 * @package AppBundle\Service\Integration
 */
class BaseRestIntegrationService
{
    /**
     * @var TranslatorInterface
     */
    protected $translator;
    /**
     * @var string
     */
    private $baseUri;
    /**
     * @var int
     */
    private $timeout;
    /**
     * @var Client
     */
    private $client;

    /**
     * BaseRestIntegrationService constructor.
     * @param TranslatorInterface $translator
     * @param string $baseUri
     * @param int $timeout
     */
    public function __construct(
        TranslatorInterface $translator,
        string $baseUri = '',
        int $timeout = 20
    ) {
        $this->translator = $translator;
        $this->baseUri = $baseUri;
        $this->timeout = $timeout;
    }

    /**
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        if (!$this->client) {
            $this->client = new Client([
                'base_uri' => $this->baseUri,
                'timeout' => $this->timeout,
            ]);
        }
        return $this->client;
    }

    /**
     * @param $contents
     * @return mixed|null
     * @throws AppServiceUnavailableException
     */
    protected function decode($contents)
    {
        $data = null;
        try {
            if (!empty($contents)) {
                $data = \GuzzleHttp\json_decode($contents, true);
            }
        } catch (\InvalidArgumentException $e) {
            throw new AppServiceUnavailableException(base64_encode($e->getMessage()));
        }
        return $data;
    }

    /**
     * @param Request $request
     * @param array $query
     * @param int $timeout
     * @return array
     * @throws AppServiceUnavailableException
     */
    protected function proxy(Request $request, array $query = [], int $timeout = 10)
    {
        try {
            /** @var Uri $uri */
            $uri = null;
            $guzzleResponse = $this->getClient()->send($request, [
                'on_stats' => function (TransferStats $stats) use (&$uri) {
                    $uri = $stats->getEffectiveUri();
                },
                'query' => $query,
                'timeout' => $timeout,
            ]);
            $contents = $guzzleResponse->getBody()->getContents();
            $status = $guzzleResponse->getStatusCode();
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $contents = $e->getResponse()->getBody();
                $status = $e->getCode();
            } else {
                throw new AppServiceUnavailableException('Pas de réponse');
            }
        } catch (GuzzleException $e) {
            throw new AppServiceUnavailableException($e);
        } catch (\Exception $e) {
            throw new AppServiceUnavailableException($e);
        }

        $data = json_decode((string) $contents, true);
        try {
            $data = \GuzzleHttp\json_decode((string) $contents, true);
        } catch (\InvalidArgumentException $e) {
            if ($status != Response::HTTP_NO_CONTENT) {
                throw new AppServiceUnavailableException(
                    'La syntaxe de la response est erronée: '.dump((string) $contents)
                    . ' >>> ' . json_last_error_msg()
                );
            }
        }

        return [
            'data' => $data,
            'status' => $status,
        ];
    }
}
