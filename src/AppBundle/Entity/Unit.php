<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Unit
 *
 * @ORM\Table(name="unit")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UnitRepository")
 */
class Unit extends BaseEntity
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\AvantSimple\Redeem", mappedBy="unit")
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
     * Set email.
     *
     * @param string $email
     *
     * @return Unit
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add redeem.
     *
     * @param \AppBundle\Entity\AvantSimple\Redeem $redeem
     *
     * @return Unit
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
