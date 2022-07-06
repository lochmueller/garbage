<?php

namespace App\Traits\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait CreatedTrait
{
    #[
        Gedmo\Timestampable(on: 'create'),
        ORM\Column(type: 'datetime'),
    ]
    public ?\DateTime $created = null;
}
