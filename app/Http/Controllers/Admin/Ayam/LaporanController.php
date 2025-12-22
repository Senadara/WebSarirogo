<?php

namespace App\Http\Controllers\Admin\Ayam;

use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.admin.ayam.laporan.index');
    }

    // Harian Form Steps
    public function harianStep1()
    {
        return view('pages.admin.ayam.laporan.forms.step1-harian');
    }

    public function harianStep2()
    {
        return view('pages.admin.ayam.laporan.forms.step2-harian');
    }

    public function harianStep3()
    {
        return view('pages.admin.ayam.laporan.forms.step3-harian');
    }
}
