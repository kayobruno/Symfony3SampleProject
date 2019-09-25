<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

abstract class CouponException extends \Exception
{
    protected $status = Response::HTTP_INTERNAL_SERVER_ERROR;

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }
}
