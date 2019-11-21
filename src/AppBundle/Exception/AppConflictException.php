<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class AppConflictException extends AppException
{
    protected $status = Response::HTTP_CONFLICT;
}
