<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class AppUnprocessableEntityException extends AppException
{
    protected $status = Response::HTTP_UNPROCESSABLE_ENTITY;
}
