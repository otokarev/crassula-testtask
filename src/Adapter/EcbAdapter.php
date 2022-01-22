<?php

namespace App\Adapter;

use App\Model\RateBundle;
use App\Model\RateProviderAdapter;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EcbAdapter implements RateProviderAdapter
{
    public function __construct(
        private HttpClientInterface $client,
        private string $url
    ) {

    }

    public function fetch(): RateBundle
    {
        $this->client->request('GET', $this->url);
        // TODO: Implement fetch() method.
    }
}
