<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class SupervisorUnprocessableEntityException extends SupervisorException
{
    protected $status = Response::HTTP_UNPROCESSABLE_ENTITY;
}
