<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class CouponBadRequestException extends CouponException
{
    protected $status = Response::HTTP_BAD_REQUEST;
}
