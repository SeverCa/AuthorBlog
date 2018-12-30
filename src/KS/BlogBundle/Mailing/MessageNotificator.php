<?php

namespace KS\BlogBundle\Mailing;

//use Symfony\Component\Security\Core\User\UserInterface;

class MessageNotificator
{
    protected $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

// Méthode pour notifier par e-mail un administrateur lors de la publication d'un post dans guestbook
// le commentaire est en attente de validation par le modo
// le modo doit cliquer sur le lien dans l'email pour validre le commentaire

    public function notifyUserByEmail($email, $content, $name, $key, $suppr, $id)
    {
        $msg = "Message de ".$name." : 

        ".$content." 
 
        Pour valider ce message, veuillez cliquer sur le lien ci dessous
        ou copier/coller dans votre navigateur internet.
         
        http://sevca.fr/validation/".urlencode($key)."/".urlencode($id)."

        Pour le supprimer, veuillez cliquer sur le lien ci-dessous
        ou copier/coller dans votre navigateur internet.

        http://sevca.fr/validation/".urlencode($suppr)."/".urlencode($id)."


        ---------------
        Ceci est un mail automatique, Merci de ne pas y répondre."; 

        $message = \Swift_Message::newInstance()
            ->setSubject("nouveau commentaire")
            ->setFrom('admin@sevca.com')
            ->setTo($email)
            ->setBody($msg);

        $this->mailer->send($message);
    }


    public function notifyAuthorByEmail($email, $title, $message, $emailTo)
    {

        $mail = \Swift_Message::newInstance()
            ->setSubject($title)
            ->setFrom($email)
            ->setTo($emailTo)
            ->setBody($message);

        $this->mailer->send($mail);
    }
}
