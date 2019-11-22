<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class AppBadRequestException extends AppException
{
    protected $status = Response::HTTP_BAD_REQUEST;
}
