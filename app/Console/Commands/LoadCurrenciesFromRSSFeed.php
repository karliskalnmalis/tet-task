<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\CurrencyImportService;
use Illuminate\Console\Command;

class LoadCurrenciesFromRSSFeed extends Command
{
    protected $signature = 'currencies:import';
    protected $description = 'Import currencies from RSS feed';

    public function handle(CurrencyImportService $importService)
    {
        $currencies = $importService->import();

        $this->getOutput()->info('Imported ' . $currencies->count() . ' successfully');
    }
}
