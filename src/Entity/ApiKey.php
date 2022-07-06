<?php

namespace App\Entity;

use App\Repository\ApiKeyRepository;
use App\Traits\Entity\CreatedTrait;
use App\Traits\Entity\IdTrait;
use App\Traits\Entity\OptInDateTrait;
use App\Traits\Entity\UpdatedTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity(repositoryClass: ApiKeyRepository::class)
]
class ApiKey
{
    use IdTrait;
    use CreatedTrait;
    use UpdatedTrait;
    use OptInDateTrait;

    public function __construct(
        #[
            Assert\NotBlank,
            Assert\Email(),
            ORM\Column(type: 'string', length: 255),
        ]
        public string $email = '',
        #[
            ORM\Column(type: 'string', length: 64),
        ]
        public string $key = '',
    ) {
    }
}
