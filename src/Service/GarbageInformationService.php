<?php

namespace App\Service;

use App\Entity\Address;
use App\Exception\NoProviderException;
use App\Provider\ProviderInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class GarbageInformationService
{
    public function __construct(protected iterable $providers, protected CacheInterface $cache)
    {
    }

    public function fetchGarbageInformation(Address $address)
    {
        $cacheKey = md5((string) $address);

        return $this->cache->get($cacheKey, function (ItemInterface $item) use ($address) {
            $item->expiresAfter(3600 * 6); // 6h

            return $this->remoteFetch($address);
        });
    }

    public function remoteFetch(Address $address)
    {
        foreach ($this->providers as $provider) {
            /** @var ProviderInterface $provider */
            if ($provider->canHandleAddress($address)) {
                return $provider->getGarbageInformation($address);
            }
        }
        throw new NoProviderException();
    }
}
