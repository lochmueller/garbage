<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use App\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity(repositoryClass: AddressRepository::class)
]
class Address
{
    use IdTrait;

    public function __construct(
        #[
            Assert\NotBlank,
            Assert\Length(min: 3, max: 255),
            ORM\Column(type: 'string', length: 255),
        ]
        public readonly string $street = '',
        #[
            Assert\NotBlank,
            Assert\Length(max: 10),
            ORM\Column(type: 'string', length: 10),
        ]
        public readonly string $houseNumber = '',
        #[
            Assert\NotBlank,
            Assert\Length(min: 3),
            ORM\Column(type: 'string', length: 10),
        ]
        public readonly string $zip = '',
        #[
            Assert\NotBlank,
            Assert\Length(min: 3, max: 50),
            ORM\Column(type: 'string', length: 50),
        ]
        public readonly string $city = '',
        #[
            Assert\NotBlank,
            Assert\Length(min: 2, max: 2),
            Assert\Regex('/^[A-Z]*$/'),
            ORM\Column(type: 'string', length: 2),
        ]
        public readonly string $country = '',
    ) {
    }
}
