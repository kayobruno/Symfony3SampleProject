<?php

namespace AppBundle\Api;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiProblemException extends HttpException
{
    /**
     * @var ApiProblem
     */
    private $apiProblem;

    public function getApiProblem()
    {
        return $this->apiProblem;
    }

    public function __construct(ApiProblem $apiProblem, \Exception $previous = null, array $headers = [], $code = 0)
    {
        $this->apiProblem = $apiProblem;
        $statusCode = $apiProblem->getStatusCode();
        $message = $apiProblem->getTitle();

        parent::__construct($statusCode, $message, $previous, $headers, $code);
    }

}
