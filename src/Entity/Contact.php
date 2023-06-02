<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[NotBlank(message: 'Please enter your full name!')]
    #[ORM\Column(length: 255)]
    private ?string $fullName = null;

    #[Assert\Email(message: 'A valid email address is necessary!')]
    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[NotBlank(message: 'Please enter your subject!')]
    #[Assert\Length(min: 10, max: 255, minMessage: 'This field must contain at least {{ limit }} characters.', maxMessage: 'This field must not contain more then {{ limit }} characters.')]
    #[ORM\Column(length: 255)]
    private ?string $subject = null;

    #[NotBlank(message: 'Please enter your message!')]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $message = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $messageRead = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isMessageRead(): ?bool
    {
        return $this->messageRead;
    }

    public function setMessageRead(bool $messageRead): self
    {
        $this->messageRead = $messageRead;

        return $this;
    }
}
