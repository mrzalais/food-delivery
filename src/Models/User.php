<?php

namespace App\Models;

class User {
    private string $email;
    private string $mobileNumber;
    private string $address;

    public function __construct(string $email, string $mobileNumber, string $address)
    {
        $this->email = $email;
        $this->mobileNumber = $mobileNumber;
        $this->address = $address;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMobileNumber(): string
    {
        return $this->mobileNumber;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}
