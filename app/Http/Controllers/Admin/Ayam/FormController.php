<?php
namespace App\Http\Controllers\Admin\Ayam;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    // harian
    public function stepHarian1()
    {
        return view('pages.admin.ayam.laporan.forms.step1-harian');
    }
}
