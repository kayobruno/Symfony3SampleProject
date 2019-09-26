<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CustomerRepository")
 */
class Customer extends BaseEntity
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
     * @ORM\Column(name="identifier", type="string", length=20, unique=true)
     */
    private $identifier;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AvantSimple\Redeem", mappedBy="customer")
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
     * Set identifier.
     *
     * @param string $identifier
     *
     * @return Customer
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier.
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Add redeem.
     *
     * @param \AppBundle\Entity\AvantSimple\Redeem $redeem
     *
     * @return Customer
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
