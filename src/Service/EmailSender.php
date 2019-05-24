<?php

namespace App\Service;

use App\Entity\Contact;
use Twig\Environment;

class EmailSender
{
    private $mailer;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(Contact $contact)
    {
        $message = (new \Swift_Message('Agence : ' . $contact->getProperty()->getTitle()))
            ->setFrom('noreply@agence.fr')
            ->setTo('contact@agence.fr')
            ->setReplyTo($contact->getEmail())
            ->setBody($this->twig->render('email/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');

        $this->mailer->send($message);
    }
}