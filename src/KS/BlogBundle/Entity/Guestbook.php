<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guestbook
 *
 * @ORM\Table(name="guestbook")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\GuestbookRepository")
 */
class Guestbook
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
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \Clef
     *
     * @ORM\Column(name="clef", type="string", length=255)
     */
    private $clef;

        /**
     * @var \Suppr
     *
     * @ORM\Column(name="suppr", type="string", length=255)
     */
    private $suppr;




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
     * Set username.
     *
     * @param string $username
     *
     * @return Guestbook
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set content.
     *
     * @param string $content
     *
     * @return Guestbook
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
     * Set active.
     *
     * @param bool $active
     *
     * @return Guestbook
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active.
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Guestbook
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



    /**
     * Set clef.
     *
     * @param string $clef
     *
     * @return Guestbook
     */
    public function setClef($clef)
    {
        $this->clef = $clef;

        return $this;
    }

    /**
     * Get clef.
     *
     * @return string
     */
    public function getClef()
    {
        return $this->clef;
    }

    /**
     * Set suppr.
     *
     * @param string $suppr
     *
     * @return Guestbook
     */
    public function setSuppr($suppr)
    {
        $this->suppr = $suppr;

        return $this;
    }

    /**
     * Get suppr.
     *
     * @return string
     */
    public function getSuppr()
    {
        return $this->suppr;
    }
}
