<?php

namespace App\Provider;

use App\Entity\Address;

interface ProviderInterface
{

    public function canHandleAddress(Address $address): bool;

    public function getGarbageInformation(Address $address);
}