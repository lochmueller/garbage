<?php

namespace App\Entity;

class Address
{

    public function __construct(
        public readonly string $street,
        public readonly string $houseNumber,
        public readonly string $zip,
        public readonly string $city,
        public readonly string $country, // UPPER alpha2 ISO Code: e.g. "DE"
    )
    {
    }

}