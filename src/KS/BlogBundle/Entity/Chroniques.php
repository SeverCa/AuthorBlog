<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Chroniques
 *
 * @ORM\Table(name="chroniques")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\ChroniquesRepository")
 */
class Chroniques
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="KS\BlogBundle\Entity\Sagas", cascade={"persist"}, inversedBy="chroniques")
     * @ORM\JoinColumn(nullable=true)
     */
    private $saga;

    /**
     * @ORM\ManyToOne(targetEntity="KS\BlogBundle\Entity\Books", cascade={"persist"}, inversedBy="chroniques")
     * @ORM\JoinColumn(nullable=true)
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity="KS\BlogBundle\Entity\Novels", cascade={"persist"}, inversedBy="chroniques")
     * @ORM\JoinColumn(nullable=true)
     */
    private $novel;


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
     * @return Chroniques
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
     * Set url.
     *
     * @param string $url
     *
     * @return Chroniques
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set saga.
     *
     * @param \KS\BlogBundle\Entity\Sagas|null $saga
     *
     * @return Chroniques
     */
    public function setSaga(\KS\BlogBundle\Entity\Sagas $saga = null)
    {
        $this->saga = $saga;

        return $this;
    }

    /**
     * Get saga.
     *
     * @return \KS\BlogBundle\Entity\Sagas|null
     */
    public function getSaga()
    {
        return $this->saga;
    }

    /**
     * Set book.
     *
     * @param \KS\BlogBundle\Entity\Books|null $book
     *
     * @return Chroniques
     */
    public function setBook(\KS\BlogBundle\Entity\Books $book = null)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * Get book.
     *
     * @return \KS\BlogBundle\Entity\Books|null
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * Set novel.
     *
     * @param \KS\BlogBundle\Entity\Novels|null $novel
     *
     * @return Chroniques
     */
    public function setNovel(\KS\BlogBundle\Entity\Novels $novel = null)
    {
        $this->novel = $novel;

        return $this;
    }

    /**
     * Get novel.
     *
     * @return \KS\BlogBundle\Entity\Novels|null
     */
    public function getNovel()
    {
        return $this->novel;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Chroniques
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
