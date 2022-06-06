<?php

namespace App\Tests\Unit\Provider;

use App\Entity\Address;
use App\Provider\GermanyBielefeld;
use App\Tests\Unit\AbstractUnitTest;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyBielefeldTest extends AbstractUnitTest
{

    public function testHandleValidAddress()
    {
        $address = new Address('Schürhornweg', '16', '33649', 'Bielefeld', 'DE');
        $provider = new GermanyBielefeld($this->createMock(HttpClient::class), $this->createMock(RequestFactoryInterface::class));
        self::assertTrue($provider->canHandleAddress($address));
    }

    public function testHandleInvalidAddress()
    {
        $address = new Address('Ballindamm', '40', '20095', 'Hamburg', 'DE');
        $provider = new GermanyBielefeld($this->createMock(HttpClient::class), $this->createMock(RequestFactoryInterface::class));
        self::assertFalse($provider->canHandleAddress($address));
    }

    public function testFetchGarbageInformation(){

        $address = new Address('Schürhornweg', '16', '33649', 'Bielefeld', 'DE');
        $provider = new GermanyBielefeld(HttpClientDiscovery::find(), Psr17FactoryDiscovery::findRequestFactory());

        $provider->getGarbageInformation($address);
    }

}
