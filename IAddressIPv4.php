<?php

interface IAddressIPv4
{
    public function __construct(string $address);
    public function isValid(): bool;
    public function set(string $address): IAddressIPv4;
    public function getAsString(): string;
    public function getAsInt(): int;
    public function getAsBinaryString(): string;
    public function getOctet(int $number): int;
    public function getClass(): string;
    public function isPrivate(): bool;

}