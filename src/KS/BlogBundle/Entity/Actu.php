<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Actu
 *
 * @ORM\Table(name="actu")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\ActuRepository")
 */
class Actu
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
     * @ORM\OneToOne(targetEntity="KS\BlogBundle\Entity\Images", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="aside", type="string", length=255)
     */
    private $aside;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="debut", type="date")
     */
    private $debut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end", type="date")
     */
    private $end;

    /**
     * @var float
     *
     * @ORM\Column(name="tarif", type="float")
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var int
     *
     * @ORM\Column(name="postalcode", type="integer")
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=1000)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=1000)
     */
    private $website;

    /**
     * @var string
     *
     * @ORM\Column(name="map", type="string", length=1000)
     */
    private $map;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    private $content;


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
     * Set name.
     *
     * @param string $name
     *
     * @return Actu
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set aside.
     *
     * @param string $aside
     *
     * @return Actu
     */
    public function setAside($aside)
    {
        $this->aside = $aside;

        return $this;
    }

    /**
     * Get aside.
     *
     * @return string
     */
    public function getAside()
    {
        return $this->aside;
    }

    /**
     * Set debut.
     *
     * @param \DateTime $debut
     *
     * @return Actu
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;

        return $this;
    }

    /**
     * Get debut.
     *
     * @return \DateTime
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * Set end.
     *
     * @param \DateTime $end
     *
     * @return Actu
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end.
     *
     * @return \DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set tarif.
     *
     * @param float $tarif
     *
     * @return Actu
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif.
     *
     * @return float
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set city.
     *
     * @param string $city
     *
     * @return Actu
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postalcode.
     *
     * @param int $postalcode
     *
     * @return Actu
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode.
     *
     * @return int
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set adresse.
     *
     * @param string $adresse
     *
     * @return Actu
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set website.
     *
     * @param string $website
     *
     * @return Actu
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website.
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set map.
     *
     * @param string $map
     *
     * @return Actu
     */
    public function setMap($map)
    {
        $this->map = $map;

        return $this;
    }

    /**
     * Get map.
     *
     * @return string
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Actu
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content.
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image.
     *
     * @param \KS\BlogBundle\Entity\Images $image
     *
     * @return Actu
     */
    public function setImage(\KS\BlogBundle\Entity\Images $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image.
     *
     * @return \KS\BlogBundle\Entity\Images
     */
    public function getImage()
    {
        return $this->image;
    }
}
