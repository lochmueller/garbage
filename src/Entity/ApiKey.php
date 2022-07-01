<?php

namespace App\Entity;

use App\Repository\ApiKeyRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Entity(repositoryClass: ApiKeyRepository::class)
]
class ApiKey
{
    #[
        ORM\Id(),
        ORM\GeneratedValue(),
        ORM\Column(type: "integer"),
    ]
    public ?int $id = null;

    public function __construct(
        #[
            Assert\NotBlank,
            Assert\Email(),
            ORM\Column(type: "string", length: 255),
        ]
        public readonly string $email,
        #[
            ORM\Column(type: "string", length: 64),
        ]
        public string          $key,
    )
    {
    }

}
