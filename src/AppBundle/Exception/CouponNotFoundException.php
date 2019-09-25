<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class CouponNotFoundException extends CouponException
{
    protected $status = Response::HTTP_NOT_FOUND;
}
