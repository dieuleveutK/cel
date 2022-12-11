<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $replyTo;
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer, $replyTo) {
        $this->mailer = $mailer;
        $this->replyTo = $replyTo;
    }
    public function sendEmail(
        $to = 'aymen.sellaouti@gmail.com',
        $content = '<p>See Twig integration for better HTML integration!</p>',
        $subject = 'Time for Symfony Mailer!'
    ): void
    {
        $email = (new Email())
            ->from('aymen.noreply@example.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            ->replyTo($this->replyTo)
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
//            ->text('Sending emails is fun again!')
            ->html($content);
        $this->mailer->send($email);
        // ...
    }

}