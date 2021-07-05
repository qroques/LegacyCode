<?php

class User
{
    private int $id;
    private string $firstname;
    private string $lastname;
    private string $mailAddress;

    public function __construct(string $firstname, string $lastname, string $mailAddress)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->mailAddress = $mailAddress;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getMailAddress(): string
    {
        return $this->mailAddress;
    }
}