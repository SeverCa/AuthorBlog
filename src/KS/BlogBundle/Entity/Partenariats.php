<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partenariats
 *
 * @ORM\Table(name="partenariats")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\PartenariatsRepository")
 */
class Partenariats
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="websitelink", type="string", length=255, nullable=true)
     */
    private $websitelink;

    /**
     * @var string|null
     *
     * @ORM\Column(name="socialmedialink", type="string", length=255, nullable=true)
     */
    private $socialmedialink;

        /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;


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
     * @return Partenariats
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
     * Set content.
     *
     * @param string $content
     *
     * @return Partenariats
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
     * Set websitelink.
     *
     * @param string|null $websitelink
     *
     * @return Partenariats
     */
    public function setWebsitelink($websitelink = null)
    {
        $this->websitelink = $websitelink;

        return $this;
    }

    /**
     * Get websitelink.
     *
     * @return string|null
     */
    public function getWebsitelink()
    {
        return $this->websitelink;
    }

    /**
     * Set socialmedialink.
     *
     * @param string|null $socialmedialink
     *
     * @return Partenariats
     */
    public function setSocialmedialink($socialmedialink = null)
    {
        $this->socialmedialink = $socialmedialink;

        return $this;
    }

    /**
     * Get socialmedialink.
     *
     * @return string|null
     */
    public function getSocialmedialink()
    {
        return $this->socialmedialink;
    }

    /**
     * Set active.
     *
     * @param bool $active
     *
     * @return Partenariats
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
     * Set image.
     *
     * @param \KS\BlogBundle\Entity\Images $image
     *
     * @return Partenariats
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

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Partenariats
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }
}
