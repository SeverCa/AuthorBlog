<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Novels
 *
 * @ORM\Table(name="novels")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\NovelsRepository")
 */
class Novels
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
     * @ORM\OneToMany(targetEntity="KS\BlogBundle\Entity\Chroniques", cascade={"persist"}, mappedBy="novel")
     * @ORM\JoinColumn(nullable=true)
     */
    private $chroniques;

    /**
     * @ORM\OneToOne(targetEntity="KS\BlogBundle\Entity\Images", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    protected $image;

    /**
     * @ORM\ManyToOne(targetEntity="KS\BlogBundle\Entity\Category", inversedBy="novels")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string
     *
     * @ORM\Column(name="aside", type="string", length=600)
     */
    private $aside;

    /**
     * @var string
     *
     * @ORM\Column(name="amazonLink", type="string", length=255, nullable=true)
     */
    private $amazonLink;

    /**
     * @var string
     *
     * @ORM\Column(name="pandaLink", type="string", length=255, nullable=true)
     */
    private $pandaLink;


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
     * @return Novels
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
     * @return Novels
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
     * Set aside
     *
     * @param string $aside
     *
     * @return Novels
     */
    public function setAside($aside)
    {
        $this->aside = $aside;

        return $this;
    }

    /**
     * Get aside
     *
     * @return string
     */
    public function getAside()
    {
        return $this->aside;
    }

    /**
     * Set image
     *
     * @param \KS\BlogBundle\Entity\Images $image
     *
     * @return Novels
     */
    public function setImage(\KS\BlogBundle\Entity\Images $image)
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
     * @return Novels
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
     * Constructor
     */
    public function __construct()
    {
        $this->chronNovel = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add chronNovel.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $chronNovel
     *
     * @return Novels
     */
    public function addChronNovel(\KS\BlogBundle\Entity\Chroniques $chronNovel)
    {
        $this->chronNovel[] = $chronNovel;

        return $this;
    }

    /**
     * Remove chronNovel.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $chronNovel
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChronNovel(\KS\BlogBundle\Entity\Chroniques $chronNovel)
    {
        return $this->chronNovel->removeElement($chronNovel);
    }

    /**
     * Get chronNovel.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChronNovel()
    {
        return $this->chronNovel;
    }

    /**
     * Add chronique.
     *
     * @param \KS\BlogBundle\Entity\Chroniques $chronique
     *
     * @return Novels
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

    /**
     * Set amazonLink.
     *
     * @param string|null $amazonLink
     *
     * @return Novels
     */
    public function setAmazonLink($amazonLink = null)
    {
        $this->amazonLink = $amazonLink;

        return $this;
    }

    /**
     * Get amazonLink.
     *
     * @return string|null
     */
    public function getAmazonLink()
    {
        return $this->amazonLink;
    }

    /**
     * Set pandaLink.
     *
     * @param string|null $pandaLink
     *
     * @return Novels
     */
    public function setPandaLink($pandaLink = null)
    {
        $this->pandaLink = $pandaLink;

        return $this;
    }

    /**
     * Get pandaLink.
     *
     * @return string|null
     */
    public function getPandaLink()
    {
        return $this->pandaLink;
    }
}
