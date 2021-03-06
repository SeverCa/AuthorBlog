<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\CategoryRepository")
 * @UniqueEntity("name", message="Nom déja utilisé")
 */
class Category
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
     * @ORM\OneToMany(targetEntity="KS\BlogBundle\Entity\Books", mappedBy="category")
     */
    private $books;

    /**
     * @ORM\OneToMany(targetEntity="KS\BlogBundle\Entity\Novels", mappedBy="category")
     */
    private $novels;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Assert\NotBlank()
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
     * @return Category
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
        $this->books = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add book.
     *
     * @param \KS\BlogBundle\Entity\Books $book
     *
     * @return Category
     */
    public function addBook(\KS\BlogBundle\Entity\Books $book)
    {
        $this->books[] = $book;

        return $this;
    }

    /**
     * Remove book.
     *
     * @param \KS\BlogBundle\Entity\Books $book
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeBook(\KS\BlogBundle\Entity\Books $book)
    {
        return $this->books->removeElement($book);
    }

    /**
     * Get books.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;
    }

    /**
     * Add novel.
     *
     * @param \KS\BlogBundle\Entity\Novels $novel
     *
     * @return Category
     */
    public function addNovel(\KS\BlogBundle\Entity\Novels $novel)
    {
        $this->novels[] = $novel;

        return $this;
    }

    /**
     * Remove novel.
     *
     * @param \KS\BlogBundle\Entity\Novels $novel
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeNovel(\KS\BlogBundle\Entity\Novels $novel)
    {
        return $this->novels->removeElement($novel);
    }

    /**
     * Get novels.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNovels()
    {
        return $this->novels;
    }
}
