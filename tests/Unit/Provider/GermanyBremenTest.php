<?php

namespace App\Tests\Unit\Provider;

use App\Entity\Address;
use App\Provider\GermanyBielefeld;
use App\Provider\GermanyBremen;

class GermanyBremenTest extends AbstractProviderTest
{
    public function getProviderClass(): string
    {
        return GermanyBremen::class;
    }

    /**
     * @medium
     */
    public function testFetchGarbageInformation()
    {
        self::markTestSkipped('Not integrated yet');
        $result = $this->getProvider()->getGarbageInformation($this->getValidAddress());
        self::assertNotEmpty($result);
    }

    public function getHandleableAddresses(): \Generator
    {
        yield [new Address('Borgfelder Str.', '17', '28215', 'Bremen', 'DE')];
    }

    public function getNotHandleableAddresses(): \Generator
    {
        yield [new Address('Ballindamm', '40', '20095', 'Hamburg', 'DE')];
    }
}
