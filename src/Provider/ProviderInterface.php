<?php

namespace App\Provider;

use App\Entity\Address;
use App\Service\DateService;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

interface ProviderInterface
{
    public function __construct(
        HttpClient $client,
        RequestFactoryInterface $requestFactory,
        DateService $dateService,
    );

    public function getProviderName(): string;

    public function canHandleAddress(Address $address): bool;

    public function getGarbageInformation(Address $address);
}
