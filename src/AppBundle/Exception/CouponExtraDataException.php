<?php

namespace AppBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

class CouponExtraDataException extends CouponException
{
    /**
     * @var array
     */
    private $extraData = [];

    /**
     * @return array
     */
    public function getExtraData(): array
    {
        return $this->extraData;
    }

    /**
     * Adiciona dados ao array extraData
     *
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        $this->extraData[$name] = $value;
        return $this;
    }

    public function setStatus($status = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        if (in_array($status, [Response::HTTP_CONFLICT, Response::HTTP_UNPROCESSABLE_ENTITY])) {
            $this->status = $status;
        }
    }
}
