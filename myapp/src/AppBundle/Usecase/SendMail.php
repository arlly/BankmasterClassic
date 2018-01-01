<?php
namespace AppBundle\Usecase;

class SendMail
{

    /**
     *
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function run(String $subject, String $from, String $to, String $body)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setFrom($from)
            ->setTo($to)
            ->setBody($body);

        $this->mailer->send($message);
    }
}
