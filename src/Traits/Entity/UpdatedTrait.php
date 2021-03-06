<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait UpdatedTrait
{
    #[
        Gedmo\Timestampable(on: 'update'),
        ORM\Column(type: 'datetime', nullable: true),
    ]
    public ?\DateTime $created = null;
}
