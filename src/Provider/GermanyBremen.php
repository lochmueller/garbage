<?php

namespace App\Provider;

use App\Entity\Address;
use App\Exception\NoResultViaProviderException;
use App\Service\DateService;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyBremen implements ProviderInterface
{
    public function __construct(
        protected HttpClient              $client,
        protected RequestFactoryInterface $requestFactory,
        protected DateService             $dateService,
    )
    {
    }

    public function canHandleAddress(Address $address): bool
    {
        $intZip = (int) $address->zip;
        return $intZip >= 28195 && $intZip <= 28779 && 'DE' == $address->country;
    }

    public function getGarbageInformation(Address $address)
    {
        // @todo
        //

        $request = $this->requestFactory->createRequest('GET', 'https://web.c-trace.de/bremenabfallkalender/Abfallkalender');
        $response = $this->client->sendRequest($request);

        if ($response->getStatusCode() !== 302) {
            throw new NoResultViaProviderException();
        }


        $matches = [];
        if (!preg_match('/\(.*\)/', $response->getHeaderLine('Location'), $matches)) {

            throw new NoResultViaProviderException();
        }

        $params = [
            'Gemeinde' => 'Bremen',
            'Strasse' => $address->street,
            'Hausnr' => $address->houseNumber,
        ];

        $icsUri = 'https://web.c-trace.de/bremenabfallkalender/' . $matches[0] . '/abfallkalender/cal?' . http_build_query($params);

        $request = $this->requestFactory->createRequest('GET', $icsUri);
        $response = $this->client->sendRequest($request);

        var_dump($response->getStatusCode());
        var_dump($response->getBody()->getContents());


        //

        // return $this->parseResults($pageResult);
    }

    public function getProviderName(): string
    {
        return 'Stadt Bremen';
    }
}
