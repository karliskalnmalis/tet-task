<?php

namespace App\Http\Controllers;

use App\Services\CurrencyExportService;
use Illuminate\Routing\Controller as BaseController;

class CurrenciesController extends BaseController
{
    public function index(CurrencyExportService $currencyExportService)
    {
        return view('index', [
            'currencies' => $currencyExportService->exportToPaginated()
        ]);
    }

    public function view(string $currencyTitle, CurrencyExportService $currencyExportService)
    {
        return view('currencyHistory', [
            'currencyHistory' => $currencyExportService->exportCurrencyHistory($currencyTitle)
        ]);
    }
}
