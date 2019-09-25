<?php

namespace AppBundle\Entity\AvantSimple;

use Doctrine\ORM\Mapping as ORM;

/**
 * Redeem
 *
 * @ORM\Table(name="redeem")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvantSimple\RedeemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Redeem
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

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
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updateTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

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
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Redeem
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt.
     *
     * @param \DateTime $updatedAt
     *
     * @return Redeem
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt.
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
