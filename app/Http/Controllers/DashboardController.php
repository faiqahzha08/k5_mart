<?php

namespace App\Http\Controllers;

use App\Services\LaporanPenjualanService;
use App\Services\MonitoringStokService;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function __construct(
        protected LaporanPenjualanService $laporanService,
        protected MonitoringStokService $stokService
    ) {}

    public function index()
    {
        $ringkasan = $this->laporanService->ringkasanHariIni();

        return view('dashboard', [
            'tanggalHariIni' => Carbon::now(),

            'ringkasan' => $ringkasan,

            // samakan dengan nama di blade
            'bestSellers' => $this->laporanService->produkTerlarisHariIni(),

            'stokRendah' => $this->stokService->produkStokRendah(),

            'stokHabis' => $this->stokService->produkStokHabis(),
        ]);
    }
}