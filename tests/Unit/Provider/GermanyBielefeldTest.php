<?php

namespace App\Tests\Unit\Provider;

use App\Entity\Address;
use App\Provider\GermanyBielefeld;

class GermanyBielefeldTest extends AbstractProviderTest
{
    public function getProviderClass(): string
    {
        return GermanyBielefeld::class;
    }

    public function getHandleableAddresses(): \Generator
    {
        yield [new Address('Schürhornweg', '16', '33649', 'Bielefeld', 'DE')];
    }

    public function getNotHandleableAddresses(): \Generator
    {
        yield [new Address('Ballindamm', '40', '20095', 'Hamburg', 'DE')];
    }
}
