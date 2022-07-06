<?php

namespace App\Provider;

use App\Entity\Address;
use App\Service\DateService;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyDortmund implements ProviderInterface
{
    public function __construct(
        protected HttpClient $client,
        protected RequestFactoryInterface $requestFactory,
        protected DateService $dateService,
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
        return 'Stadt Dortmund';
    }
}
