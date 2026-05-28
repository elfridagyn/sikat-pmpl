<?php

namespace App\Exports;

use App\Models\AssetFinance;

use Maatwebsite\Excel\Concerns\FromCollection;

class FinanceExport implements FromCollection
{
    public function collection()
    {
        return AssetFinance::all();
    }
}