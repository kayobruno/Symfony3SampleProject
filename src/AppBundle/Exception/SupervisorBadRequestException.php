<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class SupervisorBadRequestException extends SupervisorException
{
    protected $status = Response::HTTP_BAD_REQUEST;
}
