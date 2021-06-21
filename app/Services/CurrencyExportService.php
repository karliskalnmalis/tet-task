<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Currency;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CurrencyExportService
{
    public function exportToPaginated(): LengthAwarePaginator
    {
        return Currency::orderBy('published_at')->paginate(20);
    }

    public function exportCurrencyHistory(string $currencyTitle): LengthAwarePaginator
    {
        return Currency::where('title', $currencyTitle)->orderByDesc('published_at')->paginate(15);
    }
}
