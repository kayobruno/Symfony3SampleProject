<?php

namespace AppBundle\Entity\AvantSimple;

use AppBundle\Entity\BaseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Coupon
 *
 * @ORM\Table(name="coupon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvantSimple\CouponRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Coupon extends BaseEntity
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
     * @ORM\Column(name="code", type="string", length=50, unique=true)
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="starts_at", type="datetime")
     */
    private $startsAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finishes_at", type="datetime")
     */
    private $finishesAt;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

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
     * Set startsAt.
     *
     * @param \DateTime $startsAt
     *
     * @return Coupon
     */
    public function setStartsAt($startsAt)
    {
        $this->startsAt = $startsAt;

        return $this;
    }

    /**
     * Get startsAt.
     *
     * @return \DateTime
     */
    public function getStartsAt()
    {
        return $this->startsAt;
    }

    /**
     * Set finishesAt.
     *
     * @param \DateTime $finishesAt
     *
     * @return Coupon
     */
    public function setFinishesAt($finishesAt)
    {
        $this->finishesAt = $finishesAt;

        return $this;
    }

    /**
     * Get finishesAt.
     *
     * @return \DateTime
     */
    public function getFinishesAt()
    {
        return $this->finishesAt;
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
