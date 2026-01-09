<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AllJurnalsExport;
use App\Exports\MyJurnalsExport;
use Maatwebsite\Excel\Facades\Excel;

class JurnalController extends Controller
{
    public function index()
    {
        $jurnals = Jurnal::orderBy('tanggal_kbm', 'desc')
            ->paginate(10);

        return view('jurnals.index', compact('jurnals'));
    }

    public function create()
    {
        return view('jurnals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_kbm'    => 'required|date',
            'kelas'          => 'required|string',
            'mata_pelajaran' => 'required|string',
            'materi'         => 'required|string',
            'kegiatan'       => 'nullable|string',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',

            'hadir' => 'required|integer',

            // checkbox / daftar nama
            'izin'  => 'nullable',
            'sakit' => 'nullable',
            'alfa'  => 'nullable',

            'dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['guru']    = auth()->user()->name;

        
        $validated['izin']  = $request->has('izin')  ? 1 : 0;
        $validated['sakit'] = $request->has('sakit') ? 1 : 0;
        $validated['alfa']  = $request->has('alfa')  ? 1 : 0;

        // UPLOAD FOTO
        if ($request->hasFile('dokumentasi')) {
            $folder = 'jurnal-photo/' . now()->format('Y-m');
            $validated['dokumentasi'] = $request
                ->file('dokumentasi')
                ->store($folder, 'public');
        }

        Jurnal::create($validated);

        return redirect()
            ->route('jurnals.index')
            ->with('success', 'Jurnal berhasil ditambahkan');
    }


    public function edit(Jurnal $jurnal)
    {
        return view('jurnals.edit', compact('jurnal'));
    }

    public function update(Request $request, Jurnal $jurnal)
    {
        $validated = $request->validate([
            'tanggal_kbm'    => 'required|date',
            'kelas'          => 'required|string',
            'mata_pelajaran' => 'required|string',
            'materi'         => 'required|string',
            'kegiatan'       => 'nullable|string',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',

            // KEHADIRAN
            'hadir' => 'required|integer',

            // NAMA MURID (TEXT)
            'izin'  => 'nullable|string',
            'sakit' => 'nullable|string',
            'alfa'  => 'nullable|string',

            'dokumentasi' => 'nullable|image|max:2048',
        ]);

        $validated['guru'] = auth()->user()->name;

        if ($request->hasFile('dokumentasi')) {
            if (
                $jurnal->dokumentasi &&
                \Storage::disk('public')->exists($jurnal->dokumentasi)
            ) {
                \Storage::disk('public')->delete($jurnal->dokumentasi);
            }

            $folder = 'jurnal-photo/' . now()->format('Y-m');
            $validated['dokumentasi'] = $request
                ->file('dokumentasi')
                ->store($folder, 'public');
        }

        $jurnal->update($validated);

        return redirect()
            ->route('jurnals.index')
            ->with('success', 'Jurnal berhasil diupdate');
    }

    public function destroy(Jurnal $jurnal)
    {
        $jurnal->delete();

        return redirect()
            ->route('jurnals.index')
            ->with('success', 'Jurnal berhasil dihapus');
    }

    public function exportMine()
    {
        return Excel::download(
            new MyJurnalsExport(auth()->id()),
            'jurnal_saya_' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    public function exportAll()
    {
        return Excel::download(
            new AllJurnalsExport,
            'semua_jurnal_' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}