<?php

namespace App\Entity;

use App\Repository\ReminderRepository;
use App\Traits\Entity\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity(repositoryClass: ReminderRepository::class)
]
class Reminder
{
    use IdTrait;

    public function __construct(
        #[
            Assert\NotBlank,
            Assert\Email(),
            ORM\Column(type: 'string', length: 255),
        ]
        public readonly string $email,

        // @todo address
    ) {
    }
}
