<?php

namespace AppBundle\EventListener;

use AppBundle\Api\ApiProblem;
use AppBundle\Api\ApiProblemException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    private $debug;
    private $logger;

    public function __construct($debug, LoggerInterface $logger)
    {
        $this->debug = $debug;
        $this->logger = $logger;
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // only reply to api URLs
        $strpos = strpos($event->getRequest()->getPathInfo(), '/api/');
        if ($strpos === false) {
            return;
        }

        $exception = $event->getException();
        $statusCode = $exception instanceof HttpExceptionInterface ? $exception->getStatusCode() : 500;

        // allow server errors to be thrown
        if (intdiv($statusCode, 100) == 5 && $this->debug) {
            return;
        }

        $this->logException($exception);

        if ($exception instanceof ApiProblemException) {
            $apiProblem = $exception->getApiProblem();
        } else {
            $apiProblem = new ApiProblem($statusCode);

            /*
             * If it's an HttpException message (e.g. for 404, 403),
             * we'll say as a rule that the exception message is safe
             * for the client. Otherwise, it could be some sensitive
             * low-level exception, which should *not* be exposed
             */
            if ($exception instanceof HttpExceptionInterface) {
                $apiProblem->set('detail', $exception->getMessage());
            }
        }

        $data = $apiProblem->toArray();
        // making type a URL, to a temporarily fake page
        if ($data['type'] != 'about:blank') {
            $data['type'] = 'http://localhost:8000/docs/errors#'.$data['type'];
            //TODO Criar página de documentação para cada tipo de erro
        }
        $response = new JsonResponse(
            $data,
            $apiProblem->getStatusCode()
        );
        $response->headers->set('Content-Type', 'application/problem+json');

        $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException'
        ];
    }

    /**
     * Adapted from the core Symfony exception handling in ExceptionListener
     *
     * @param \Exception $exception
     */
    private function logException(\Exception $exception)
    {
        $message = sprintf(
            'Uncaught PHP Exception %s: "%s" at %s line %s',
            get_class($exception),
            $exception->getMessage(),
            $exception->getFile(),
            $exception->getLine()
        );
        $isCritical = !$exception instanceof HttpExceptionInterface || $exception->getStatusCode() >= 500;
        $context = array('exception' => $exception);
        if ($isCritical) {
            $this->logger->critical($message, $context);
        } else {
            $this->logger->error($message, $context);
        }
    }
}
