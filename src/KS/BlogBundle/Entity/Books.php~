<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use KS\BlogBundle\Entity\Category;
use KS\BlogBundle\Entity\Images;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Books
 *
 * @ORM\Table(name="books")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\BooksRepository")
 * @UniqueEntity("name", message="Nom déja utilisé")
 */
class Books
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
     * @ORM\OneToMany(targetEntity="KS\BlogBundle\Entity\Chroniques", cascade={"persist"}, mappedBy="book")
     * @ORM\JoinColumn(nullable=true)
     */
    private $chroniques;

    /**
     * @ORM\OneToOne(targetEntity="KS\BlogBundle\Entity\Images", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="KS\BlogBundle\Entity\Category", inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="KS\BlogBundle\Entity\Sagas", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $saga;


    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="numero", type="integer")
     */
    private $numero;

        /**
     * @var int
     *
     * @ORM\Column(name="nbpages", type="integer")
     */
    private $nbpages;

    /**
     * @var float
     *
     * @ORM\Column(name="internetPrice", type="float")
     */
    private $internetPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="physicalPrice", type="float")
     */
    private $physicalPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="amazonLink", type="string", length=255)
     */
    private $amazonLink;

        /**
     * @var string
     *
     * @ORM\Column(name="amazonApercu", type="string", length=255)
     */
    private $amazonApercu;

        /**
     * @var string
     *
     * @ORM\Column(name="isbn", type="string", length=255)
     */
    private $isbn;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * @return Books
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
     * Set content
     *
     * @param string $content
     *
     * @return Books
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     *
     * @return Books
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return int
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set internetPrice
     *
     * @param float $internetPrice
     *
     * @return Books
     */
    public function setInternetPrice($internetPrice)
    {
        $this->internetPrice = $internetPrice;

        return $this;
    }

    /**
     * Get internetPrice
     *
     * @return float
     */
    public function getInternetPrice()
    {
        return $this->internetPrice;
    }

    /**
     * Set physicalPrice
     *
     * @param float $physicalPrice
     *
     * @return Books
     */
    public function setPhysicalPrice($physicalPrice)
    {
        $this->physicalPrice = $physicalPrice;

        return $this;
    }

    /**
     * Get physicalPrice
     *
     * @return float
     */
    public function getPhysicalPrice()
    {
        return $this->physicalPrice;
    }

    /**
     * Set amazonLink
     *
     * @param string $amazonLink
     *
     * @return Books
     */
    public function setAmazonLink($amazonLink)
    {
        $this->amazonLink = $amazonLink;

        return $this;
    }

    /**
     * Get amazonLink
     *
     * @return string
     */
    public function getAmazonLink()
    {
        return $this->amazonLink;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Books
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set image
     *
     * @param \KS\BlogBundle\Entity\Images $image
     *
     * @return Books
     */
    public function setImage(\KS\BlogBundle\Entity\Images $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \KS\BlogBundle\Entity\Images
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \KS\BlogBundle\Entity\Category $category
     *
     * @return Books
     */
    public function setCategory(\KS\BlogBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \KS\BlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set saga
     *
     * @param \KS\BlogBundle\Entity\Sagas $saga
     *
     * @return Books
     */
    public function setSaga(\KS\BlogBundle\Entity\Sagas $saga)
    {
        $this->saga = $saga;

        return $this;
    }

    /**
     * Get saga
     *
     * @return \KS\BlogBundle\Entity\Sagas
     */
    public function getSaga()
    {
        return $this->saga;
    }

    /**
     * Set nbpages
     *
     * @param integer $nbpages
     *
     * @return Books
     */
    public function setNbpages($nbpages)
    {
        $this->nbpages = $nbpages;

        return $this;
    }

    /**
     * Get nbpages
     *
     * @return integer
     */
    public function getNbpages()
    {
        return $this->nbpages;
    }

    /**
     * Set amazonApercu
     *
     * @param string $amazonApercu
     *
     * @return Books
     */
    public function setAmazonApercu($amazonApercu)
    {
        $this->amazonApercu = $amazonApercu;

        return $this;
    }

    /**
     * Get amazonApercu
     *
     * @return string
     */
    public function getAmazonApercu()
    {
        return $this->amazonApercu;
    }

    /**
     * Set isbn
     *
     * @param string $isbn
     *
     * @return Books
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;

        return $this;
    }

    /**
     * Get isbn
     *
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->chroniques = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add chronique.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $chronique
     *
     * @return Books
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
