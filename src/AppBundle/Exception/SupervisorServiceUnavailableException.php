<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class SupervisorServiceUnavailableException extends SupervisorException
{
    protected $status = Response::HTTP_SERVICE_UNAVAILABLE;
}
