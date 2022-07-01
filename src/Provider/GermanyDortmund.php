<?php


namespace App\Provider;


use App\Entity\Address;
use App\Exception\NoResultViaProviderException;
use App\Garbage\Bio;
use App\Garbage\Paper;
use App\Garbage\ResidualWaste;
use App\Garbage\ReusableMaterials;
use GuzzleHttp\Psr7\MultipartStream;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyDortmund implements ProviderInterface
{


    public function __construct(
        protected HttpClient              $client,
        protected RequestFactoryInterface $requestFactory,
    )
    {
    }

    protected $validZip = [

    ];


    public function canHandleAddress(Address $address): bool
    {
        return in_array($address->zip, $this->validZip) && $address->country == 'DE';
    }

    public function getGarbageInformation(Address $address)
    {

        // @todo
        //


        #return $this->parseResults($pageResult);
    }


    public function getProviderName(): string
    {
        return 'Stadt Dortmund';
    }
}

