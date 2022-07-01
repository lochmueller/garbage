<?php

namespace App\Entity;

use App\Repository\ApiKeyRepository;
use App\Repository\ReminderRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Entity(repositoryClass: ReminderRepository::class)
]
class Reminder
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

        // @todo address
    )
    {
    }

}
