<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class CouponUnprocessableEntityException extends CouponException
{
    protected $status = Response::HTTP_UNPROCESSABLE_ENTITY;
}
