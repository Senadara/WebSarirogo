<?php

namespace App\Http\Controllers\Admin\Ayam;

use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.admin.ayam.laporan.index');
    }
}
