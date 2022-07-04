<?php

namespace App\Provider;

use App\Entity\Address;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyBerlin implements ProviderInterface
{
    public function __construct(
        protected HttpClient $client,
        protected RequestFactoryInterface $requestFactory,
    ) {
    }

    protected $validZip = [
    ];

    public function canHandleAddress(Address $address): bool
    {
        return in_array($address->zip, $this->validZip) && 'DE' == $address->country;
    }

    public function getGarbageInformation(Address $address)
    {
        // @todo
        //

        // return $this->parseResults($pageResult);
    }

    public function getProviderName(): string
    {
        return 'Stadt Berlin';
    }
}
