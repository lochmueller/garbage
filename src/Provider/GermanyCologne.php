<?php

namespace App\Provider;

use App\Entity\Address;
use App\Exception\NoResultViaProviderException;
use App\Garbage\Paper;
use App\Garbage\ReusableMaterials;
use App\Service\DateService;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyCologne implements ProviderInterface
{
    protected const API = 'https://www.awbkoeln.de/api/';

    public function __construct(
        protected HttpClient $client,
        protected RequestFactoryInterface $requestFactory,
        protected DateService $dateService,
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
        $query = [
            'street_name' => $address->street,
            'building_number' => $address->houseNumber,
            'building_number_addition' => '',
            'form' => 'json',
        ];

        $uri = self::API.'streets?'.http_build_query($query);
        $request = $this->requestFactory->createRequest('GET', $uri);
        $response = $this->client->sendRequest($request);

        $content = json_decode((string) $response->getBody());

        if (!isset($content->data) || !is_array($content->data) || empty($content->data)) {
            throw new NoResultViaProviderException();
        }

        $row = $content->data[0];

        $query = [
            'building_number' => $row->building_number,
            'street_code' => $row->street_code,
            'start_year' => $this->dateService->getSelectionStart()->format('Y'),
            'end_year' => $this->dateService->getSelectionEnd()->format('Y'),
            'start_month' => $this->dateService->getSelectionStart()->format('m'),
            'end_month' => $this->dateService->getSelectionEnd()->format('m'),
            'form' => 'json',
        ];
        $uri = self::API.'calendar?'.http_build_query($query);

        $request = $this->requestFactory->createRequest('GET', $uri);
        $response = $this->client->sendRequest($request);

        $finalResult = json_decode((string) $response->getBody());

        if (!isset($finalResult->data)) {
            throw new NoResultViaProviderException();
        }

        $result = [];
        foreach ($finalResult->data as $item) {
            try {
                $date = new \DateTime($item->day.'.'.$item->month.'.'.$item->year);
            } catch (\Exception) {
                continue;
            }

            switch ($item->type) {
                case 'wertstoff':
                    $result[ReusableMaterials::KEY][] = $date;
                    break;
                case 'grey':
                    $result[ReusableMaterials::KEY][] = $date;
                    break;
                case 'blue':
                    $result[Paper::KEY][] = $date;
                    break;
                default:
                    // @todo Add logger
            }
        }

        return $result;
    }

    public function getProviderName(): string
    {
        return 'Stadt Köln';
    }
}
