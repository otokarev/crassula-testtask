<?php

namespace App\Adapter;

use App\Model\RateHistoryRecord as RateHistoryRecordInterface;
use App\Model\RateHistoryRecordFetcher;
use App\Model\RateHistoryRecordFactory;
use Carbon\Carbon;
use DOMDocument;
use DOMNode;
use DOMXPath;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EcbRateHistoryRecordFetcher implements RateHistoryRecordFetcher
{
    public function __construct(
        private HttpClientInterface $client,
        private string $url,
        private RateHistoryRecordFactory $factory,
    ) {

    }

    /**
     * TODO: Add error handling
     *
     * @return RateHistoryRecordInterface
     */
    public function fetch(): RateHistoryRecordInterface
    {
        $response = $this->client->request('GET', $this->url);

        $doc = new DOMDocument();
        $doc->loadXML($response->getContent());

        $xpath = new DOMXPath($doc);

        $nodes = $xpath->query("//*[@time]");
        $at = Carbon::createFromFormat('Y-m-d', $nodes[0]->attributes->getNamedItem('time')->nodeValue);

        $nodes = $xpath->query("//*[@currency]");

        $values = [];
        /** @var DOMNode $node */
        foreach ($nodes as $node) {
            $currency = $node->attributes->getNamedItem('currency')->nodeValue;
            $values[$currency] = $node->attributes->getNamedItem('rate')->nodeValue;
        }

        return $this->factory->newRateHistoryRecord('EUR', $values, $at, true);
    }
}
