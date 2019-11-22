<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class AppNotFoundException extends AppException
{
    protected $status = Response::HTTP_NOT_FOUND;
}
