<?php

namespace App\Tests\Unit\Provider;

use App\Entity\Address;
use App\Provider\GermanyBielefeld;
use App\Provider\GermanyCologne;
use App\Tests\Unit\AbstractUnitTest;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyCologneTest extends AbstractProviderTest
{

    /**
     * @medium
     */
    public function testFetchGarbageInformation()
    {
        $this->markTestSkipped('SKIP');
        $result = $this->getProvider()->getGarbageInformation($this->getValidAddress());
        var_dump($result);



    }

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
