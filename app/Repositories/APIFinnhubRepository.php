<?php
namespace App\Repositories;

use Finnhub;
use GuzzleHttp;


class APIFinnhubRepository
{

    public function getQuote(string $symbol): Finnhub\Model\Quote

    {
        $config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'c1n9rna37fkt0cimnp8g');
        $client = new Finnhub\Api\DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );

        return $client->quote($symbol);

    }




}


