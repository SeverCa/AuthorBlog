<?php

namespace KS\BlogBundle\Mailing;

use KS\BlogBundle\Event\MessagePostEvent;
use KS\BlogBundle\Event\ContactPostEvent;

class MessageListener
{
protected $notificator;
protected $req = array();

public function __construct(MessageNotificator $notificator, $req)
{
$this->notificator = $notificator;
$this->req = $req;
}

    public function processAdvert(MessagePostEvent $event)
    {
        $name = $event->getUser();
        $content = $event->getMessage();
        $key = $event->getKey();
        $suppr = $event->getSuppr();
        $id = $event->getId();
        $email = 'xxx@gmail.com';

        $this->notificator->notifyUserByEmail($email, $content, $name, $key, $suppr, $id);
        return;
    }

    public function processContact(ContactPostEvent $event)
    {
        $email = $event->getEmail();
        $title = $event->getTitle();
        $content = $event->getMessage();
        $emailTo = 'xxx@gmail.com';

        $this->notificator->notifyAuthorByEmail($email, $title, $content, $emailTo);
        return;
    }

}
