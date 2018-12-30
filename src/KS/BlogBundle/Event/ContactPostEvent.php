<?php


namespace KS\BlogBundle\Event;

use Symfony\Component\EventDispatcher\Event;
//use Symfony\Component\Security\Core\User\UserInterface;

class ContactPostEvent extends Event
{
    protected $email;
    protected $title;
    protected $message;

    
    public function __construct($email, $title, $message)
    {
        $this->email = $email;
        $this->title = $title;
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        return $this->message = $message;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        return $this->title = $title;
    }



}