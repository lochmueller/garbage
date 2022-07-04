<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

trait IdTrait
{
    #[
        ORM\Id(),
        ORM\GeneratedValue(),
        ORM\Column(type: 'integer'),
    ]
    public ?int $id = null;
}
