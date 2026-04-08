<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Cycle\Annotated\Annotation as Cycle;

#[Cycle\Entity(repository: UserRepository::class)]
class User
{
    #[Cycle\Column(type: 'primary')]
    private ?int $id = null;

    #[Cycle\Column(type: 'string', unique: true)]
    private ?string $email = null;

    #[Cycle\Column(type: 'string')]
    private ?string $password = null;

    #[Cycle\Column(type: 'json')]
    private array $roles = [];

    #[Cycle\Column(type: 'datetime')]
    private ?\DateTimeImmutable $createdAt = null;

    #[Cycle\Column(type: 'datetime')]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): self
    {
        if (!$createdAt) {
            $this->createdAt = new \DateTimeImmutable();
            return $this;
        }

        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
