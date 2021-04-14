<?php

namespace App\Repositories;


use Doctrine\Common\Cache\Cache;
use Finnhub;
use GuzzleHttp;


class APIFinnhubRepository
{
    private Cache $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function getCache(string $symbol): string
    {
        $id = $symbol;
        if (!$this->cache->fetch($id)) {
            $currentPrice = $this->getQuote($id)['c'];
            $this->cache->save($id, $currentPrice, 60);
            return $this->cache->fetch($id);
        }
        return $this->cache->fetch($id);
    }

    private function getQuote(string $symbol): Finnhub\Model\Quote
    {
        $config = Finnhub\Configuration::getDefaultConfiguration()->setApiKey('token', 'c1n9rna37fkt0cimnp8g');
        $client = new Finnhub\Api\DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
        return $client->quote($symbol);
    }

}


