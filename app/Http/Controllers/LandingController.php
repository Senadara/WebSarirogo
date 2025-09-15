<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Plant;
use App\Models\Report;
use App\Models\Cage;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use App\Models\Land;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index()
    {
        // 1. Populasi Ternak Berdasarkan Kategori (ayam, ikan, kambing)
        $populasiAyam = Animal::whereHas('cage', function ($query) {
            $query->where('cage_category', 'Ayam');
        })->where('status', 'Alive')->count();

        $populasiIkan = Animal::whereHas('cage', function ($query) {
            $query->where('cage_category', 'Ikan');
        })->where('status', 'Alive')->count();

        $populasiKambing = Animal::whereHas('cage', function ($query) {
            $query->where('cage_category', 'Kambing');
        })->where('status', 'Alive')->count();

        // 2. Statistik Panen Pertanian
        $tanaman = Plant::with('category', 'land')->get();

        $dataTanaman = $tanaman->map(function ($plant) {
            return [
                'kategori' => $plant->category->name_category ?? '-',
                'total_tanaman' => $plant->total,
                'luas_lahan' => $plant->land->wide ?? 0,
                'nama_lahan' => $plant->land->land_name ?? '-',
            ];
        });

        // 3. Kondisi Kesehatan Ternak
        $laporanBulanIni = Report::whereMonth('date', Carbon::now()->month)->get();

        $laporanStatistik = [
            'growth' => $laporanBulanIni->where('source', 'growth')->count(),
            'dead' => $laporanBulanIni->where('source', 'dead')->count(),
            'new' => $laporanBulanIni->where('source', 'new')->count(),
        ];

        // 4. Jumlah Kandang dan Isinya
        $totalKandang = Cage::count();
        $totalHidup = Cage::sum('total_life');
        $totalMati = Cage::sum('total_dead');

        // 5. Inventory
        $inventory = Inventory::with('category')->get();

        $stokInventory = $inventory->map(function ($item) {
            return [
                'nama' => $item->name,
                'kategori' => $item->category->name_category ?? '-',
                'total' => $item->total,
            ];
        });

        // 6. Transaksi Peternakan/Pertanian
        $bulanIni = Carbon::now()->month;

        $transaksi = Transaction::whereMonth('date', $bulanIni)->get();

        $totalIncome = $transaksi->where('type', 'IN')->sum('amount');
        $totalOutcome = $transaksi->where('type', 'OUT')->sum('amount');

        return view('landing.index', compact(
            'populasiAyam',
            'populasiIkan',
            'populasiKambing',
            'dataTanaman',
            'laporanStatistik',
            'totalKandang',
            'totalHidup',
            'totalMati',
            'stokInventory',
            'totalIncome',
            'totalOutcome'
        ));
    }
}
