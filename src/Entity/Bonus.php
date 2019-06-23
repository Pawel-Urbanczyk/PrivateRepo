<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BonusRepository")
 */
class Bonus
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
    private $dzial;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nazwa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $EAN;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cena;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $minLiczbaSztuk;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prowizja;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poprzedniaCena;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $poprzedniaProwizja;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $komentarzCena;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $komentarzProwizja;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDzial(): ?string
    {
        return $this->dzial;
    }

    public function setDzial(string $dzial): self
    {
        $this->dzial = $dzial;

        return $this;
    }

    public function getNazwa(): ?string
    {
        return $this->nazwa;
    }

    public function setNazwa(string $nazwa): self
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    public function getEAN(): ?string
    {
        return $this->EAN;
    }

    public function setEAN(string $EAN): self
    {
        $this->EAN = $EAN;

        return $this;
    }

    public function getCena(): ?string
    {
        return $this->cena;
    }

    public function setCena(string $cena): self
    {
        $this->cena = $cena;

        return $this;
    }

    public function getMinLiczbaSztuk(): ?string
    {
        return $this->minLiczbaSztuk;
    }

    public function setMinLiczbaSztuk(string $minLiczbaSztuk): self
    {
        $this->minLiczbaSztuk = $minLiczbaSztuk;

        return $this;
    }

    public function getProwizja(): ?string
    {
        return $this->prowizja;
    }

    public function setProwizja(string $prowizja): self
    {
        $this->prowizja = $prowizja;

        return $this;
    }

    public function getPoprzedniaCena(): ?string
    {
        return $this->poprzedniaCena;
    }

    public function setPoprzedniaCena(string $poprzedniaCena): self
    {
        $this->poprzedniaCena = $poprzedniaCena;

        return $this;
    }

    public function getPoprzedniaProwizja(): ?string
    {
        return $this->poprzedniaProwizja;
    }

    public function setPoprzedniaProwizja(string $poprzedniaProwizja): self
    {
        $this->poprzedniaProwizja = $poprzedniaProwizja;

        return $this;
    }

    public function getKomentarzCena(): ?string
    {
        return $this->komentarzCena;
    }

    public function setKomentarzCena(string $komentarzCena): self
    {
        $this->komentarzCena = $komentarzCena;

        return $this;
    }

    public function getKomentarzProwizja(): ?string
    {
        return $this->komentarzProwizja;
    }

    public function setKomentarzProwizja(string $komentarzProwizja): self
    {
        $this->komentarzProwizja = $komentarzProwizja;

        return $this;
    }
}
