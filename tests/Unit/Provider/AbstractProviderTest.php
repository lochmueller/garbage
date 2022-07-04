<?php

namespace App\Tests\Unit\Provider;

use App\Entity\Address;
use App\Provider\ProviderInterface;
use App\Tests\Unit\AbstractUnitTest;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;

abstract class AbstractProviderTest extends AbstractUnitTest
{
    abstract public function getProviderClass(): string;

    abstract public function getHandleableAddresses(): \Generator;

    abstract public function getNotHandleableAddresses(): \Generator;

    /**
     * @dataProvider getHandleableAddresses
     */
    public function testHandleableAddress(Address $address)
    {
        self::assertTrue($this->getProvider()->canHandleAddress($address));
    }

    /**
     * @dataProvider getNotHandleableAddresses
     */
    public function testNotHandleableAddress(Address $address)
    {
        self::assertFalse($this->getProvider()->canHandleAddress($address));
    }

    protected function getProvider(): ProviderInterface
    {
        $providerClass = $this->getProviderClass();

        return new $providerClass(HttpClientDiscovery::find(), Psr17FactoryDiscovery::findRequestFactory());
    }

    protected function getValidAddress(): Address
    {
        $firstItem = $this->getHandleableAddresses()->current();

        return $firstItem[0];
    }
}
