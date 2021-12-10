<?php

namespace App\Service;

use App\Model\Contact;
use PHPUnit\Framework\Exception;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $mailer;

    private $config;

    public function __construct(MailerInterface $mailer, ParameterBagInterface $parameterBag)
    {
        $this->mailer = $mailer;
        $this->config = $parameterBag->get('mailer');
    }

    public function sendSupport(Contact $contact)
    {
        return $this->send($this->config['supportAddress'], 'Nouvelle demande de support', 'support', [
            'contact' => $contact
        ]);
    }

    private function send($to, $subject, $template, $context)
    {
        $email = new TemplatedEmail();
        $email->from($this->config['senderAddress']);
        $email->subject($subject);
        $email->to($to);
        $templatePath = sprintf('%s%s.html.twig',$this->config['templateFolder'], $template);
        $email->htmlTemplate($templatePath);
        $email->context($context);
        try {
            $this->mailer->send($email);
            return true;
        } catch (Exception $e) {
            return false;
        }

    }
}