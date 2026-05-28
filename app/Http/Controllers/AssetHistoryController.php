<?php

namespace App\Http\Controllers;

use App\Models\AssetHistory;

use Illuminate\Http\Request;

class AssetHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = AssetHistory::with([
            'asset',
            'user'
        ]);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->search) {

            $query->where(
                'aktivitas',
                'like',
                '%' . $request->search . '%'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER AKTIVITAS
        |--------------------------------------------------------------------------
        */

        if ($request->aktivitas) {

            $query->where(
                'aktivitas',
                $request->aktivitas
            );
        }

        $histories = $query
            ->latest('tanggal')
            ->paginate(10);

        return view(
            'asset-histories.index',
            compact('histories')
        );
    }
}