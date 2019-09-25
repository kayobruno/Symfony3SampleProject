<?php

namespace AppBundle\Entity\AvantSimple;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Promotion
 *
 * @ORM\Table(name="promotion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvantSimple\PromotionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Promotion
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
     * @var int|null
     *
     * @ORM\Column(name="service_id", type="integer", nullable=true)
     */
    private $serviceId;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="begins_at", type="datetime", nullable=true)
     */
    private $beginsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ends_at", type="datetime")
     */
    private $endsAt;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float|null
     *
     * @ORM\Column(name="percentage", type="float", nullable=true)
     */
    private $percentage;

    /**
     * @var int
     *
     * @ORM\Column(name="uses_by_redeemer", type="integer")
     */
    private $usesByRedeemer;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AvantSimple\Coupon", mappedBy="promotion")
     */
    private $coupons;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->coupons = new ArrayCollection();
    }

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
     * Set serviceId.
     *
     * @param int|null $serviceId
     *
     * @return Promotion
     */
    public function setServiceId($serviceId = null)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get serviceId.
     *
     * @return int|null
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set beginsAt.
     *
     * @param \DateTime|null $beginsAt
     *
     * @return Promotion
     */
    public function setBeginsAt($beginsAt = null)
    {
        $this->beginsAt = $beginsAt;

        return $this;
    }

    /**
     * Get beginsAt.
     *
     * @return \DateTime|null
     */
    public function getBeginsAt()
    {
        return $this->beginsAt;
    }

    /**
     * Set endsAt.
     *
     * @param \DateTime $endsAt
     *
     * @return Promotion
     */
    public function setEndsAt($endsAt)
    {
        $this->endsAt = $endsAt;

        return $this;
    }

    /**
     * Get endsAt.
     *
     * @return \DateTime
     */
    public function getEndsAt()
    {
        return $this->endsAt;
    }

    /**
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return Promotion
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set percentage.
     *
     * @param float|null $percentage
     *
     * @return Promotion
     */
    public function setPercentage($percentage = null)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage.
     *
     * @return float|null
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * Set usesByRedeemer.
     *
     * @param int $usesByRedeemer
     *
     * @return Promotion
     */
    public function setUsesByRedeemer($usesByRedeemer)
    {
        $this->usesByRedeemer = $usesByRedeemer;

        return $this;
    }

    /**
     * Get usesByRedeemer.
     *
     * @return int
     */
    public function getUsesByRedeemer()
    {
        return $this->usesByRedeemer;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Promotion
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
     * @return Promotion
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
     * Add coupon.
     *
     * @param \AppBundle\Entity\AvantSimple\Coupon $coupon
     *
     * @return Promotion
     */
    public function addCoupon(\AppBundle\Entity\AvantSimple\Coupon $coupon)
    {
        $this->coupons[] = $coupon;

        return $this;
    }

    /**
     * Remove coupon.
     *
     * @param \AppBundle\Entity\AvantSimple\Coupon $coupon
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCoupon(\AppBundle\Entity\AvantSimple\Coupon $coupon)
    {
        return $this->coupons->removeElement($coupon);
    }

    /**
     * Get coupons.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoupons()
    {
        return $this->coupons;
    }
}
