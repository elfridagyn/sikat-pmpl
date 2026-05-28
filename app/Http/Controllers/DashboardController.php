<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use App\Models\AssetHistory;
use App\Models\AssetFinance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. DATA GRAFIK HARIAN (7 Hari Terakhir)
        $dailyCounts = ['Mon' => 0, 'Tue' => 0, 'Wed' => 0, 'Thu' => 0, 'Fri' => 0, 'Sat' => 0, 'Sun' => 0];
        
        $assetsDaily = Asset::select(DB::raw('DATE_FORMAT(created_at, "%a") as day'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('day')
            ->pluck('total', 'day');

        foreach ($assetsDaily as $day => $total) {
            if (array_key_exists($day, $dailyCounts)) {
                $dailyCounts[$day] = $total;
            }
        }

        // 2. DATA GRAFIK BULANAN (Januari - Desember Tahun Ini)
        $monthlyCounts = array_fill(1, 12, 0);
        
        $assetsMonthly = Asset::select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as total'))
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('total', 'month');

        foreach ($assetsMonthly as $month => $total) {
            $monthlyCounts[$month] = $total;
        }

        $data = [
            'chartData' => [
                Asset::where('status', 'aktif')->count(),
                Asset::where('status', 'non-aktif')->count()
            ],
            'totalAsset' => Asset::count(),
            'totalActive' => Asset::where('status', 'aktif')->count(),
            'totalInactive' => Asset::where('status', 'non-aktif')->count(),
            'totalCategory' => Category::count(),
            'recentActivities' => AssetHistory::latest()->take(5)->get(),
            'lowStocks' => Asset::where('jumlah', '<=', 3)->get(),
            'highExpenses' => AssetFinance::where('nominal', '>=', 10000000)->get(),
            
            // Generate array value murni
            'chartDailyData' => array_values($dailyCounts),
            'chartMonthlyData' => array_values($monthlyCounts)
        ];

        if (Auth::user()->role == 'manajemen') {
            return view('dashboard-manajemen', $data);
        }

        return view('dashboard', $data);
    }
}