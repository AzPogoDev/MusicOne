<?php

namespace App\Service;

use App\Entity\Address;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class LocationService
{
    private $httpClient;
    private $config;

    public function __construct(HttpClientInterface $httpClient, ParameterBagInterface $config)
    {
        $this->httpClient = $httpClient;
        $this->config = $config->get('location');

    }

    public function checkAddress(Address $address)
    {
        $url = sprintf("mapbox.places/%s.json", $address->getZipcode());
        $result = $this->call($url, [
            'country' => $address->getCountry(),
            'types' => 'postcode'
        ]);

        if (empty($result)) {
            return false;
        }

        $result = array_shift($result);

        foreach ($result['context'] as $context) {
            if ($context['text'] == $address->getCity()) {
                return true;
            }
        }
        return false;
    }

    private function call(string $endpoint, array $data, string $method = "GET")
    {
        $url = sprintf("%s%s", $this->config['url'], $endpoint);
        $query = [
            'access_token' => $this->config['key'],
        ];
        if ($method === 'GET') {
            $query = array_merge($query, $data);
        }

        $response = $this->httpClient->request($method, $url, [
            'query' => $query
        ]);


        return $response->toArray()['features'];
    }
}