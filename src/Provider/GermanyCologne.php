<?php

namespace App\Provider;

use App\Entity\Address;
use App\Exception\NoResultViaProviderException;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyCologne implements ProviderInterface
{
    protected const API = 'https://www.awbkoeln.de/api/';

    public function __construct(
        protected HttpClient $client,
        protected RequestFactoryInterface $requestFactory,
    ) {
    }

    protected $validZip = [
        '50667',
        '50668',
        '50670',
        '50672',
        '50674',
        '50676',
        '50677',
        '50678',
        '50679',
        '50733',
        '50735',
        '50737',
        '50739',
        '50765',
        '50767',
        '50769',
        '50823',
        '50825',
        '50827',
        '50829',
        '50858',
        '50859',
        '50931',
        '50933',
        '50935',
        '50937',
        '50939',
        '50968',
        '50969',
        '50996',
        '50997',
        '50999',
        '51061',
        '51063',
        '51065',
        '51067',
        '51069',
        '51103',
        '51105',
        '51107',
        '51109',
        '51143',
        '51145',
        '51147',
        '51149',
    ];

    public function canHandleAddress(Address $address): bool
    {
        return in_array($address->zip, $this->validZip) && 'DE' == $address->country;
    }

    public function getGarbageInformation(Address $address)
    {
        $uri = self::API.'streets?street_name='.$address->street.'&building_number='.$address->houseNumber.'&building_number_addition=&form=json';
        $request = $this->requestFactory->createRequest('GET', $uri);
        $response = $this->client->sendRequest($request);

        $content = json_decode((string) $response->getBody());

        if (!isset($content->data) || !is_array($content->data) || empty($content->data)) {
            throw new NoResultViaProviderException();
        }

        $row = $content->data[0];

        $uri = self::API.'calendar?building_number='.$row->building_number.'&street_code='.$row->street_code.'&start_year='.date('Y').'&end_year='.date('Y').'&start_month=1&end_month=12&form=json';
        var_dump($uri);
        $request = $this->requestFactory->createRequest('GET', $uri);
        $response = $this->client->sendRequest($request);

        $finalResult = json_decode((string) $response->getBody());

        // var_dump($finalResult);

        // @todo
        //

        // return $this->parseResults($pageResult);
    }

    public function getProviderName(): string
    {
        return 'Stadt Köln';
    }
}
