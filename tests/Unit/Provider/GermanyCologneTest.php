<?php

namespace App\Tests\Unit\Provider;

use App\Entity\Address;
use App\Provider\GermanyCologne;

class GermanyCologneTest extends AbstractProviderTest
{
    public function getProviderClass(): string
    {
        return GermanyCologne::class;
    }

    public function getHandleableAddresses(): \Generator
    {
        yield [new Address('Palmstraße', '27', '50672', 'Köln', 'DE')];
    }

    public function getNotHandleableAddresses(): \Generator
    {
        yield [new Address('Ballindamm', '40', '20095', 'Hamburg', 'DE')];
    }
}
