<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class CouponServiceUnavailableException extends CouponException
{
    protected $status = Response::HTTP_SERVICE_UNAVAILABLE;
}
