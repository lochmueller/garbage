<?php

namespace App\Provider;

use App\Entity\Address;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyEnger implements ProviderInterface
{
    public function __construct(
        protected HttpClient $client,
        protected RequestFactoryInterface $requestFactory,
    ) {
    }

    protected $validZip = [
        '32130',
    ];

    public function canHandleAddress(Address $address): bool
    {
        return in_array($address->zip, $this->validZip) && 'DE' == $address->country;
    }

    public function getGarbageInformation(Address $address)
    {
        // https://www.enger.de/Leben-in-Enger/Planen-Bauen-Wohnen/Abfall-Stra%C3%9Fenreinigung/Abfallkalender/index.php?set=fix&ort=393.6&strasse=1470.5.1&vtyp=1&vMo=06&bMo=12&vJ=2022&call=suche&La=1&css=&bn=&Barriere=&sNavID=1470.485&mNavID=1470.4&ffmod=abf&ffsm=1&once=1
        // @todo
    }

    public function getProviderName(): string
    {
        return 'Enger';
    }
}
