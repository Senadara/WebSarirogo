<?php

namespace App\Http\Controllers\Admin\Ayam;

use App\Http\Controllers\Controller;

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

   public function create(int $step)
    {
        return view('pages.admin.ayam.kandang.forms.form', [
            'step' => $step,
            'mode' => 'create',
            'kandang' => null,
        ]);
    }
}
