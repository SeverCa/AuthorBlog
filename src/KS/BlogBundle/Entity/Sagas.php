<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Sagas
 *
 * @ORM\Table(name="sagas")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\SagasRepository")
 * @UniqueEntity("name", message="Nom déja utilisé")
 */
class Sagas
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
     * @ORM\OneToMany(targetEntity="KS\BlogBundle\Entity\Chroniques", cascade={"persist"}, mappedBy="saga")
     * @ORM\JoinColumn(nullable=true)
     */
    private $chroniques;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Sagas
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->saga = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add saga.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $saga
     *
     * @return Sagas
     */
    public function addSaga(\KS\BlogBundle\Entity\Chroniques $saga)
    {
        $this->saga[] = $saga;

        return $this;
    }

    /**
     * Remove saga.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $saga
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSaga(\KS\BlogBundle\Entity\Chroniques $saga)
    {
        return $this->saga->removeElement($saga);
    }

    /**
     * Get saga.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSaga()
    {
        return $this->saga;
    }

    /**
     * Add chronique.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $chronique
     *
     * @return Sagas
     */
    public function addChronique(\KS\BlogBundle\Entity\Chroniques $chronique)
    {
        $this->chroniques[] = $chronique;

        return $this;
    }

    /**
     * Remove chronique.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $chronique
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChronique(\KS\BlogBundle\Entity\Chroniques $chronique)
    {
        return $this->chroniques->removeElement($chronique);
    }

    /**
     * Get chroniques.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChroniques()
    {
        return $this->chroniques;
    }
}
