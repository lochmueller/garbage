<?php


namespace App\Provider;


use App\Entity\Address;
use App\Garbage\Bio;
use App\Garbage\Paper;
use App\Garbage\ResidualWaste;
use App\Garbage\ReusableMaterials;
use GuzzleHttp\Psr7\MultipartStream;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestFactoryInterface;

class GermanyBielefeld implements ProviderInterface
{

    public function __construct(
        protected HttpClient              $client,
        protected RequestFactoryInterface $requestFactory,
    )
    {
    }

    protected $validZip = [
        '33602',
        '33604',
        '33605',
        '33607',
        '33609',
        '33611',
        '33613',
        '33615',
        '33617',
        '33647',
        '33649',
        '33699',
        '33739'
    ];


    public function canHandleAddress(Address $address): bool
    {
        return in_array($address->zip, $this->validZip) && $address->country == 'DE';
    }

    public function getGarbageInformation(Address $address)
    {

        $request = $this->requestFactory->createRequest('GET', 'https://anwendungen.bielefeld.de/WasteManagementBielefeld/WasteManagementServlet?SubmitAction=wasteDisposalServices');
        $response = $this->client->sendRequest($request->withBody($this->createBody('wasteDisposalServices')));

        $sessionId = null;
        foreach ($response->getHeaders()['Set-Cookie'] ?? [] as $item) {
            if (str_starts_with($item, 'JSESSIONID=')) {
                $parts = explode(';', $item);
                $sessionId = substr($parts[0], 11);
            }
        }

        if ($sessionId === null) {
            throw new \Exception('No session was created', 123671823);
        }

        $headers = $this->getHeaders($response->getHeaders()['Set-Cookie']);

        $finalRequest = $this->requestFactory->createRequest('POST', 'https://anwendungen.bielefeld.de/WasteManagementBielefeld/WasteManagementServlet');
        $finalRequest = $finalRequest->withBody($this->createBody('forward', $sessionId, $address));
        foreach ($headers as $key => $value) {
            $finalRequest = $finalRequest->withHeader($key, $value);
        }
        $finalResponse = $this->client->sendRequest($finalRequest);

        $pageResult = $finalResponse->getBody()->getContents();

        return $this->parseResults($pageResult);
    }

    protected function parseResults(string $content)
    {
        preg_match('#<UL class=\\\\"flexiblelist\\\\" ID=\\\\"TermineM\\\\">(.*?)</UL>#', $content, $restMatches);
        preg_match('#<UL class=\\\\"flexiblelist\\\\" ID=\\\\"TermineB\\\\">(.*?)</UL>#', $content, $bioMatches);
        preg_match('#<UL class=\\\\"flexiblelist\\\\" ID=\\\\"TermineP\\\\">(.*?)</UL>#', $content, $paperMatches);
        preg_match('#<UL class=\\\\"flexiblelist\\\\" ID=\\\\"TermineW\\\\">(.*?)</UL>#', $content, $wertstoffMatches);

        return [
            ResidualWaste::KEY => $this->getDateList($restMatches[1]),
            Bio::KEY => $this->getDateList($bioMatches[1]),
            Paper::KEY => $this->getDateList($paperMatches[1]),
            ReusableMaterials::KEY => $this->getDateList($wertstoffMatches[1]),
        ];
    }

    protected function getDateList($match): array
    {
        $firstStep = strip_tags(str_replace(["</P>", "!"], "\n", $match));
        $dates = explode("\n", $firstStep);
        return array_filter(array_map('trim', $dates), function ($item) {
            return !empty($item);
        });
    }

    protected function getHeaders(array $cookieItems): array
    {
        return [
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:101.0) Gecko/20100101 Firefox/101.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,*/*;q=0.8',
            'Accept-Language' => 'de-DE,de;q=0.5',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Origin' => 'https://anwendungen.bielefeld.de',
            'Referer' => 'https://anwendungen.bielefeld.de/WasteManagementBielefeld/WasteManagementServlet',
            'Cookie' => implode('; ', array_map(function ($cookieItem) {
                $parts = explode(';', $cookieItem);
                return $parts[0];
            }, $cookieItems)),
            'Upgrade-Insecure-Requests' => '1',
            'Sec-Fetch-Dest' => 'document',
            'Sec-Fetch-Mode' => 'navigate',
            'Sec-Fetch-Site' => 'same-origin',
            'Sec-Fetch-User' => '?1',
        ];
    }

    protected function createBody(string $action, ?string $sessionId = null, ?Address $address = null)
    {
        $params = [
            'Ajax' => 'false',
            'AjaxDelay' => '0',
            #'ApplicationName' => 'com.athos.kd.bielefeld.ObjectAddressForWasteDisposalBusinessCase',
            'ApplicationName' => 'com.athos.kd.bielefeld.CheckAbfuhrTermineParameterBusinessCase',
            'Build' => '2021-10-11 9:00',
            'Focus' => 'Hausnummer',
            'ID' => '',
            'InFrameMode' => 'FALSE',
            'IsLastPage' => 'false',
            'IsSubmitPage' => 'false',
            'Method' => 'POST',
            'ModulName' => '',
            'NewTab' => 'default',
            'NextPageName' => '',
            'PageName' => 'AngabeLageadresse',
            'PageXMLVers' => '1.0',
            'VerticalOffset' => '0',
            'RedirectFunctionNachVorgang' => '',
            'SessionId' => $sessionId,
            'ShowMenue' => 'true',
            'SubmitAction' => $action,
            'ContainerGewaehlt_1' => 'on',
            'ContainerGewaehlt_2' => 'on',
            'ContainerGewaehlt_3' => 'on',
            'ContainerGewaehlt_4' => 'on',
            'Ort' => $address instanceof Address ? substr($address->street, 0, 1) : '',
            'Strasse' => $address instanceof Address ? $address->street : '',
            'Hausnummer' => $address instanceof Address ? $address->houseNumber : '',
            'Hausnummerzusatz' => '',
        ];

        return new MultipartStream(array_map(function ($key, $value) {
            return [
                'name' => $key,
                'contents' => $value,

            ];
        }, array_keys($params), $params));
    }

}

