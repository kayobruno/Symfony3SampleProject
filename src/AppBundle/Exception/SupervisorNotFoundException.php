<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class SupervisorNotFoundException extends SupervisorException
{
    protected $status = Response::HTTP_NOT_FOUND;
}
