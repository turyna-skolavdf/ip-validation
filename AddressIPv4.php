<?php

require "IAddressIPv4.php";

class AddressIPv4 implements IAddressIPv4
{
    private string $address;

    /**
     * @throws Exception
     */
    public function __construct(string $address)
    {
        $this->set($address);
    }

    public function isValid(): bool
    {
        $octets = $this->getOctets();
        foreach ($octets as $octet) {
            if($octet > 255 || $octet < 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * @throws Exception
     */
    public function set(string $address): IAddressIPv4
    {
        $this->address = $address;
        if(!$this->isValid()) throw new Exception("Zadaná adresa není validní");
        return $this;
    }

    public function getAsString(): string
    {
        return $this->address;
    }

    public function getAsInt(): int
    {
        $octets = $this->getOctets();
        return $octets[0]*(256**3) + $octets[1]*(256**2) + $octets[2]*(256**1) + $octets[3]*(256**0);
    }

    private function getOctets(): array
    {
        return explode('.', $this->address);
    }

    public function getAsBinaryString($separator = "."): string
    {
        $octets = $this->getOctets();
        foreach ($octets as $i => $octet) {
            $octets[$i] = decbin($octet);
        }
        return implode($separator, $octets);
    }

    /**
     * @throws Exception
     */
    public function getOctet(int $number): int
    {
        if($number > 4 || $number < 1) throw new Exception("Můžete vybrat pouze mezi 1. a 4. oktetem");
        return $this->getOctets()[$number - 1];
    }

    public function getClass(): string
    {
       return $this::class;
    }

    public function isPrivate(): bool
    {
        $octets = $this->getOctets();
        return
            ($octets[0] === "10" && ($octets[1] > 0 && $octets[1] <= 255)) ||
            ($octets[0] === "172" && ($octets[1] > 16 && $octets[1] <= 31)) ||
            ($octets[0] === "192" && $octets[1] === "168" && ($octets[2] > 0 && $octets[2] <= 255));
    }
}