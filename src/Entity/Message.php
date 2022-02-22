<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     * Assert\NotBlank()
     * Assert\Length(min=2 max=100)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * Assert\NotBlank()
     * Assert\Length(min=2 max=100)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * Assert\NotBlank()
     * Assert\Email()
     */
    private $email;

    /**
     *@ORM\Column(type="text", nullable=true)
     * Assert\NotBlank()
     * Assert\Regex{pattern="/^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$/"}
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * Assert\NotBlank()
     * Assert\Length(min=10)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $messageRead;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getMessageRead(): ?bool
    {
        return $this->messageRead;
    }

    public function setMessageRead(?bool $messageRead): self
    {
        $this->messageRead = $messageRead;

        return $this;
    }
}
