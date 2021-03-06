<?php

namespace AppBundle\Service\Integration;

use AppBundle\Exception\AppServiceUnavailableException;
use GuzzleHttp\Psr7\Request;

class KernelIntegrationService extends BaseRestIntegrationService
{
    /**
     * Obtem os dados de uma unidade, com base no seu e-mail
     *
     * @param string $unitEmail
     * @return array
     * @throws AppServiceUnavailableException
     */
    public function getUnitInfo(string $unitEmail = null): array
    {
        $uri = $this->getBaseUri() . 'units' . $unitEmail ? "/$unitEmail" : '';
        $proxy = $this->proxy(new Request('GET', $uri));
        return $proxy;
    }
}
