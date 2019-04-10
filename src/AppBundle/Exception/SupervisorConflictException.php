<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class SupervisorConflictException extends SupervisorException
{
    protected $status = Response::HTTP_CONFLICT;
}
