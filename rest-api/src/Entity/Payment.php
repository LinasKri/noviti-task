<?php

namespace App\Entity;

use App\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $loanAmount = null;

    #[ORM\Column]
    private ?int $termInMonths = null;

    #[ORM\Column]
    private ?float $remainingAmount = null;

    #[ORM\Column]
    private ?float $principal = null;

    #[ORM\Column]
    private ?float $interest = null;

    #[ORM\Column]
    private ?float $total = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoanAmount(): ?int
    {
        return $this->loanAmount;
    }

    public function setLoanAmount(int $loanAmount): static
    {
        $this->loanAmount = $loanAmount;

        return $this;
    }

    public function getTermInMonths(): ?int
    {
        return $this->termInMonths;
    }

    public function setTermInMonths(int $termInMonths): static
    {
        $this->termInMonths = $termInMonths;

        return $this;
    }

    public function getRemainingAmount(): ?float
    {
        return $this->remainingAmount;
    }

    public function setRemainingAmount(float $remainingAmount): static
    {
        $this->remainingAmount = $remainingAmount;

        return $this;
    }

    public function getPrincipal(): ?float
    {
        return $this->principal;
    }

    public function setPrincipal(float $principal): static
    {
        $this->principal = $principal;

        return $this;
    }

    public function getInterest(): ?float
    {
        return $this->interest;
    }

    public function setInterest(float $interest): static
    {
        $this->interest = $interest;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

        return $this;
    }
}
