<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProvidersRepository")
 */
class Providers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ProviderName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mnemonic;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProviderName(): ?string
    {
        return $this->ProviderName;
    }

    public function setProviderName(string $ProviderName): self
    {
        $this->ProviderName = $ProviderName;

        return $this;
    }

    public function getMnemonic(): ?string
    {
        return $this->mnemonic;
    }

    public function setMnemonic(string $mnemonic): self
    {
        $this->mnemonic = $mnemonic;

        return $this;
    }
}
