<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class AppServiceUnavailableException extends AppException
{
    protected $status = Response::HTTP_SERVICE_UNAVAILABLE;
}
