<?php

namespace KS\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Interviews
 *
 * @ORM\Table(name="interviews")
 * @ORM\Entity(repositoryClass="KS\BlogBundle\Repository\InterviewsRepository")
 */
class Interviews
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
     * @ORM\Column(name="aside", type="string", length=255)
     */
    private $aside;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;


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
     * Set aside.
     *
     * @param string $aside
     *
     * @return Interviews
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
     * Set url.
     *
     * @param string $url
     *
     * @return Interviews
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

}
