<?php

namespace App\Model;

use libphonenumber\PhoneNumber;
use libphonenumber\PhoneNumberType;
use Symfony\Component\Validator\Constraints as Assert;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

class Contact
{
    const TOPIC = [
        'Question générale' => 'generic',
        'Question précise' => 'precises',
        'Autres' => 'other',
    ];

    /**
     * @Assert\NotBlank(message="Vide")
     * @Assert\Email(message="Email invalid")
     */
    private $email;

    /**
     * @Assert\NotBlank(message="Vide")
     * @Assert\Length(
     *     min=2,
     *     max=64,
     * )
     */
    private $name;

    /**
     * @Assert\NotBlank(message="Vide")
     * @Assert\Length(
     *     min=20,
     *     max=1200,
     * )
     */
    private $message;

    private $phone;

    private $topic;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getPhone(): ?PhoneNumber
    {
        return $this->phone;
    }

    public function setPhone(?PhoneNumber $phone)
    {
        $this->phone = $phone;
        return $this;
    }

    public function getTopic(): string
    {
        return $this->topic;
    }

    public function setTopic(string $topic)
    {
        $this->topic = $topic;
        return $this;
    }


}