<?php

namespace App\Http\Controllers\Admin\Ayam;

use App\Http\Controllers\Controller;
use App\Models\Cage;
use App\Services\NotificationService;
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

    public function create(int $step)
    {
        return view('pages.admin.ayam.kandang.forms.form', [
            'step' => $step,
            'mode' => 'create',
            'kandang' => session('kandang', []),
        ]);
    }

    public function storeStep(Request $request, int $step)
    {
        $kandang = session('kandang', []);

        if ($step === 1) {
            $kandang['step1'] = $request->validate([
                'nama_kandang' => 'required|string',
                'tipe_kandang' => 'required|string',
                'lokasi' => 'required|string',
                'foto_kandang' => 'required|image|mimes:jpg,jpeg,png'
            ]);

            if ($request->hasFile('foto_kandang')) {
                $kandang['step1']['foto_kandang'] = $request->file('foto_kandang')->store('tmp/kandang');
            }
        }

        if ($step === 2) {
            $kandang['step2'] = $request->validate([
                'umur_ayam' => 'required|integer',
                'total_populasi_saat_ini' => 'required|integer',
                'total_populasi_awal' => 'required|integer',
                'fase_ayam' => 'required|in:starter,grower,production,afkir'
            ]);
        }

        if ($step === 3) {
            $kandang['step3'] = $request->validate([
                'catatan' => 'nullable|string'
            ]);
        }

        session(['kandang' => $kandang]);

        return redirect()->route(
            $step < 3 ? 'admin.ayam.kandang.create' : 'admin.ayam.kandang.index',
            $step < 3 ? $step + 1 : []
        );
    }

    public function store()
    {
        $data = session('kandang');

        if (!$data) {
            abort(403, 'sesion kosong');
        }

        if (!isset($data['step1'], $data['step2'])) {
            abort(400, 'Data form tidak lengkap');
        }

        $payload = array_merge(
            $data['step1'],
            $data['step2'],
            $data['step3'] ?? []
        );

        $validated = validator(
            $payload,
            [
                'nama' => 'required|string|max100',
                'lokasi'      => 'required|string',
                'cage_category' => 'required|string|max:50',
                'total_life'    => 'nullable|integer|min:0',
                'total_dead'    => 'nullable|integer|min:0',
            ]
        )->validate();

        $cage = Cage::create([
            'cage_name'     => $validated['cage_name'],
            'location'      => $validated['location'],
            'cage_category' => $validated['cage_category'],
            'total_life'    => $validated['total_life'] ?? 0,
            'total_dead'    => $validated['total_dead'] ?? 0,
        ]);

        // Create notification for new cage
        NotificationService::notifyCreate('Kandang', $cage->id, $cage->cage_name);

        session()->forget('kandang');

        return redirect()
            ->route('admin.ayam.kandang.index')
            ->with('success', 'kandang berhasil di tambahkan');
    }
}
