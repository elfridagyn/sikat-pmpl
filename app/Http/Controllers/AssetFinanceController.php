<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\AssetFinance;
use Illuminate\Support\Facades\DB;
use App\Exports\FinanceExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AssetFinanceController extends Controller
{
    public function index(Request $request)
    {
        $query = AssetFinance::with('asset');

        /*
    |--------------------------------------------------------------------------
    | FILTER BULAN
    |--------------------------------------------------------------------------
    */

        if ($request->bulan) {

            $query->whereMonth(
                'tanggal_transaksi',
                $request->bulan
            );
        }

        $finances = $query
            ->latest()
            ->paginate(10);

        /*
    |--------------------------------------------------------------------------
    | TOTAL FINANCE
    |--------------------------------------------------------------------------
    */

        $totalFinance =
            $query->sum('nominal');

        /*
    |--------------------------------------------------------------------------
    | CHART DATA
    |--------------------------------------------------------------------------
    */

        $chart = AssetFinance::select(

            'jenis_transaksi',

            DB::raw(
                'SUM(nominal) as total'
            )

        )
            ->groupBy('jenis_transaksi')
            ->get();

        return view(
            'asset-finances.index',
            compact(
                'finances',
                'totalFinance',
                'chart'
            )
        );
    }

    public function create()
    {
        return view('asset-finances.create', [

            'assets' => Asset::all()

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'asset_id' =>
            'required',

            'jenis_transaksi' =>
            'required',

            'nominal' =>
            'required|numeric|min:0',

            'tanggal_transaksi' =>
            'required'

        ]);

        AssetFinance::create([

            'asset_id' =>
            $request->asset_id,

            'jenis_transaksi' =>
            $request->jenis_transaksi,

            'nominal' =>
            $request->nominal,

            'tanggal_transaksi' =>
            $request->tanggal_transaksi

        ]);

        return redirect()
            ->route('asset-finances.index')
            ->with(
                'success',
                'Data finance berhasil ditambahkan'
            );
    }
    public function exportExcel()
    {
        return Excel::download(

            new FinanceExport,

            'finance-asset.xlsx'

        );
    }
    public function exportPdf()
    {
        $finances =
            AssetFinance::with('asset')->get();

        $pdf = Pdf::loadView(

            'asset-finances.pdf',

            compact('finances')

        );
        

        return $pdf->download(
            'laporan-finance.pdf'
        );
    }
    
}
