<?php

namespace App\Adapter;

use App\Entity\RateHistoryRecord;
use App\Model\RateHistory;
use App\Model\RateHistoryProvider;
use Carbon\Carbon;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CbrRateHistoryProviderAdapter implements RateHistoryProvider
{
    public function __construct(
        private HttpClientInterface $client,
        private string $url
    ) {

    }

    /**
     * TODO: error handling
     * @return RateHistory
     * @throws TransportExceptionInterface
     */
    public function fetch(): RateHistory
    {
        $response = $this->client->request('GET', $this->url);

        $data = simplexml_load_string($response->getContent());

        $at = Carbon::createFromFormat('d.m.Y', (string)$data->attributes()->Date);

        $values = [];
        foreach ($data->Valute as $item) {
            $currency = (string)$item->CharCode;
            $values[$currency] = str_replace(',', '.', (string)$item->Value);
        }

        // TODO: move it to factory
        return (new RateHistoryRecord())
            ->setBase('RUB')
            ->setAt($at)
            ->setValues($values)
        ;
    }
}
