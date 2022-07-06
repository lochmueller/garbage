<?php

namespace App\Entity;

use App\Repository\ReminderRepository;
use App\Traits\Entity\CreatedTrait;
use App\Traits\Entity\IdTrait;
use App\Traits\Entity\UpdatedTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[
    ORM\Entity(repositoryClass: ReminderRepository::class)
]
class Reminder
{
    use IdTrait;
    use CreatedTrait;
    use UpdatedTrait;

    public function __construct(
        #[
            Assert\NotBlank,
            Assert\Email(),
            ORM\Column(type: 'string', length: 255),
        ]
        public string $email = '',

        // @todo address
    ) {
    }
}
