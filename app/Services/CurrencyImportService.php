<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Currency;
use Feed;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;

class CurrencyImportService
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    
    public function import(): Collection
    {
        $url = 'https://www.bank.lv/vk/ecb_rss.xml';

        try {
            $rss = Feed::loadRss($url);
        } catch (\FeedException $e) {
            $this->logger->warning($e->getMessage(), $e->getTrace());

            return collect();
        }

        $currencies = collect();

        foreach ($rss->item as $item) {
            foreach ($this->parseDescription((string) $item->description) as $currencyInfo) {
                $currencies->push(
                    new Currency(
                        [
                            'title' => $currencyInfo[0],
                            'rate' => $currencyInfo[1],
                            'published_at' => strtotime((string) $item->pubDate)
                        ]
                    )
                );
            }
        }

        Currency::insert($currencies->toArray());

        return $currencies;
    }

    private function parseDescription(string $description): array
    {
        $descriptionAsArray = explode(' ', $description);

        return array_chunk(array_filter($descriptionAsArray), 2);
    }
}
