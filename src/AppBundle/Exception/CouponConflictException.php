<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class CouponConflictException extends CouponException
{
    protected $status = Response::HTTP_CONFLICT;
}
