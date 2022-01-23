<?php

namespace App\Adapter;

use App\Entity\RateHistoryRecord;
use App\Model\RateHistoryRecord as RateHistoryRecordInterface;
use App\Model\RateHistoryProvider;
use Carbon\Carbon;
use DOMDocument;
use DOMNode;
use DOMXPath;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EcbRateHistoryProviderAdapter implements RateHistoryProvider
{
    public function __construct(
        private HttpClientInterface $client,
        private string $url
    ) {

    }

    /**
     * TODO: Add error handling
     *
     * @return RateHistoryRecordInterface
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
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

        // TODO: move it to factory
        return (new RateHistoryRecord())
            ->setBase('EUR')
            ->setAt($at)
            ->setValues($values)
            ->setInverse(true)
        ;
    }
}
