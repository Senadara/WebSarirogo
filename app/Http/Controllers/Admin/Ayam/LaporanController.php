<?php

namespace App\Http\Controllers\Admin\Ayam;

use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        return view('pages.admin.ayam.laporan.index');
    }

    public function create(string $type, int $step)
    {
        abort_unless(
            in_array($type, ['harian', 'panen', 'insiden']),
            404
        );

        abort_if($step < 1 || $step > 3, 404);

        return view('pages.admin.ayam.laporan.create', [
            'type' => $type,
            'step' => $step,
        ]);
    }

    public function detail(string $type, int $id)
    {
        abort_unless(
            in_array($type, ['harian', 'panen', 'insiden']),
            404
        );

        return view("pages.admin.ayam.laporan.details.$type-detail", [
            'id' => $id,
            'type' => $type,
        ]);
    }
}
