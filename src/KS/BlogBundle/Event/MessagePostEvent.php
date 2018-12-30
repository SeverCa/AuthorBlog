<?php


namespace KS\BlogBundle\Event;

use Symfony\Component\EventDispatcher\Event;
//use Symfony\Component\Security\Core\User\UserInterface;

class MessagePostEvent extends Event
{
    protected $message;
    protected $user;
    protected $key;
    protected $suppr;
    protected $id;

    public function __construct($message, $user, $key, $suppr, $id)
    {
        $this->message = $message;
        $this->user = $user;
        $this->key = $key;
        $this->suppr = $suppr;
        $this->id = $id;
    }

// Le listener doit avoir accès au message
    public function getMessage()
    {
        return $this->message;
    }

// Le listener doit pouvoir modifier le message
    public function setMessage($message)
    {
        return $this->message = $message;
    }

    
    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        return $this->key = $key;
    }


    public function getSuppr()
    {
        return $this->suppr;
    }

    public function setSuppr($suppr)
    {
        return $this->suppr = $suppr;
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        return $this->id = $id;
    }


// Le listener doit avoir accès à l'utilisateur
    public function getUser()
    {
        return $this->user;
    }

// Pas de setUser, les listeners ne peuvent pas modifier l'auteur du message 

}