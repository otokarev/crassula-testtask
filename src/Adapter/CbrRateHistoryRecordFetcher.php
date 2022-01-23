<?php

namespace App\Adapter;

use App\Model\RateHistoryRecord as RateHistoryRecordInterface;
use App\Model\RateHistoryRecordFetcher;
use App\Model\RateHistoryRecordFactory;
use Carbon\Carbon;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CbrRateHistoryRecordFetcher implements RateHistoryRecordFetcher
{
    public function __construct(
        private HttpClientInterface $client,
        private string $url,
        private RateHistoryRecordFactory $factory,
    ) {

    }

    /**
     * TODO: error handling
     * @return RateHistoryRecordInterface
     */
    public function fetch(): RateHistoryRecordInterface
    {
        $response = $this->client->request('GET', $this->url);

        $data = simplexml_load_string($response->getContent());

        $at = Carbon::createFromFormat('d.m.Y', (string)$data->attributes()->Date);

        $values = [];
        foreach ($data->Valute as $item) {
            $currency = (string)$item->CharCode;
            $values[$currency] = str_replace(',', '.', (string)$item->Value);
        }

        return $this->factory->newRateHistoryRecord('RUB', $values, $at);
    }
}
