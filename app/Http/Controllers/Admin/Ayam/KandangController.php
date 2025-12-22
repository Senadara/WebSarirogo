<?php

namespace App\Http\Controllers\Admin\Ayam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    public function index()
    {
        return view('pages.admin.ayam.kandang.index');
    }

    public function show()
    {
        return view('pages.admin.ayam.kandang.show');
    }
}
