<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;

trait OptInDateTrait
{
    #[
        ORM\Column(type: 'datetime', nullable: true),
    ]
    public ?\DateTime $optInDate = null;
}
