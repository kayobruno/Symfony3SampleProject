<?php

namespace AppBundle\Entity\AvantSimple;

use AppBundle\Entity\BaseEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Redeem
 *
 * @ORM\Table(name="redeem")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvantSimple\RedeemRepository")
 */
class Redeem extends BaseEntity
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AvantSimple\Coupon", inversedBy="redeems")
     */
    private $coupon;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer", inversedBy="redeems")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Unit", inversedBy="redeems")
     */
    private $unit;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set coupon.
     *
     * @param \AppBundle\Entity\AvantSimple\Coupon|null $coupon
     *
     * @return Redeem
     */
    public function setCoupon(\AppBundle\Entity\AvantSimple\Coupon $coupon = null)
    {
        $this->coupon = $coupon;

        return $this;
    }

    /**
     * Get coupon.
     *
     * @return \AppBundle\Entity\AvantSimple\Coupon|null
     */
    public function getCoupon()
    {
        return $this->coupon;
    }

    /**
     * Set customer.
     *
     * @param \AppBundle\Entity\Customer|null $customer
     *
     * @return Redeem
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer.
     *
     * @return \AppBundle\Entity\Customer|null
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set unit.
     *
     * @param \AppBundle\Entity\Unit|null $unit
     *
     * @return Redeem
     */
    public function setUnit(\AppBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit.
     *
     * @return \AppBundle\Entity\Unit|null
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
