<?php

namespace AppBundle\Entity\AvantSimple;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Coupon
 *
 * @ORM\Table(name="coupon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvantSimple\CouponRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Coupon
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begins_at", type="datetime")
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AvantSimple\Promotion", inversedBy="coupons")
     */
    private $promotion;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AvantSimple\Redeem", mappedBy="coupon")
     */
    private $redeems;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->redeems = new ArrayCollection();
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
     * Set code.
     *
     * @param string $code
     *
     * @return Coupon
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set beginsAt.
     *
     * @param \DateTime $beginsAt
     *
     * @return Coupon
     */
    public function setBeginsAt($beginsAt)
    {
        $this->beginsAt = $beginsAt;

        return $this;
    }

    /**
     * Get beginsAt.
     *
     * @return \DateTime
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
     * @return Coupon
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
     * @return Coupon
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
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Coupon
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
     * @return Coupon
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
     * Set promotion.
     *
     * @param \AppBundle\Entity\AvantSimple\Promotion|null $promotion
     *
     * @return Coupon
     */
    public function setPromotion(\AppBundle\Entity\AvantSimple\Promotion $promotion = null)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion.
     *
     * @return \AppBundle\Entity\AvantSimple\Promotion|null
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Add redeem.
     *
     * @param \AppBundle\Entity\AvantSimple\Redeem $redeem
     *
     * @return Coupon
     */
    public function addRedeem(\AppBundle\Entity\AvantSimple\Redeem $redeem)
    {
        $this->redeems[] = $redeem;

        return $this;
    }

    /**
     * Remove redeem.
     *
     * @param \AppBundle\Entity\AvantSimple\Redeem $redeem
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeRedeem(\AppBundle\Entity\AvantSimple\Redeem $redeem)
    {
        return $this->redeems->removeElement($redeem);
    }

    /**
     * Get redeems.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRedeems()
    {
        return $this->redeems;
    }
}
