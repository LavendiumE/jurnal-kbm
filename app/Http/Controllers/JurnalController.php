<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\AllJurnalsExport;
use App\Exports\MyJurnalsExport;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;


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
            'ruang'          => 'required|string',
            'mata_pelajaran' => 'required|string',
            'materi'         => 'required|string',
            'kegiatan'       => 'nullable|string',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',

            'hadir' => 'required|integer',

            'izin'  => 'nullable|string',
            'sakit' => 'nullable|string',
            'alfa'  => 'nullable|string',

            'dokumentasi' => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['guru']    = auth()->user()->name;

        // UPLOAD + AUTO COMPRESS FOTO (NATIVE PHP GD)
        if ($request->hasFile('dokumentasi')) {

            $file = $request->file('dokumentasi');

            // Ambil info gambar
            $imageInfo = getimagesize($file->getPathname());
            $mime = $imageInfo['mime'];

            // Buat image resource
            if ($mime === 'image/jpeg') {
                $source = imagecreatefromjpeg($file->getPathname());
            } elseif ($mime === 'image/png') {
                $source = imagecreatefrompng($file->getPathname());
            } else {
                throw new \Exception('Format gambar tidak didukung');
            }

            $width  = imagesx($source);
            $height = imagesy($source);

            // Resize (max width 1280)
            $newWidth  = 1280;
            $newHeight = intval($height * ($newWidth / $width));

            if ($width < 1280) {
                $newWidth  = $width;
                $newHeight = $height;
            }

            $canvas = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $canvas,
                $source,
                0, 0, 0, 0,
                $newWidth,
                $newHeight,
                $width,
                $height
            );

            // Simpan hasil compress
            $folder = 'jurnal-photo/' . now()->format('Y-m');
            $filename = uniqid('jurnal_') . '.jpg';

            ob_start();
            imagejpeg($canvas, null, 75); // QUALITY 75%
            $imageData = ob_get_clean();

            \Storage::disk('public')->put($folder . '/' . $filename, $imageData);

            imagedestroy($source);
            imagedestroy($canvas);

            $validated['dokumentasi'] = $folder . '/' . $filename;
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
            'ruang'          => 'required|string',
            'mata_pelajaran' => 'required|string',
            'materi'         => 'required|string',
            'kegiatan'       => 'nullable|string',
            'jam_mulai'      => 'required',
            'jam_selesai'    => 'required',

            // KEHADIRAN
            'hadir' => 'required|integer',


            'izin'  => 'nullable|string',
            'sakit' => 'nullable|string',
            'alfa'  => 'nullable|string',

            'dokumentasi' => 'nullable|image|max:10240',
        ]);

        $validated['guru'] = auth()->user()->name;

       // UPLOAD + AUTO COMPRESS FOTO (NATIVE PHP GD)
        if ($request->hasFile('dokumentasi')) {

            $file = $request->file('dokumentasi');

            // Ambil info gambar
            $imageInfo = getimagesize($file->getPathname());
            $mime = $imageInfo['mime'];

            // Buat image resource
            if ($mime === 'image/jpeg') {
                $source = imagecreatefromjpeg($file->getPathname());
            } elseif ($mime === 'image/png') {
                $source = imagecreatefrompng($file->getPathname());
            } else {
                throw new \Exception('Format gambar tidak didukung');
            }

            $width  = imagesx($source);
            $height = imagesy($source);

            // Resize (max width 1280)
            $newWidth  = 1280;
            $newHeight = intval($height * ($newWidth / $width));

            if ($width < 1280) {
                $newWidth  = $width;
                $newHeight = $height;
            }

            $canvas = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresampled(
                $canvas,
                $source,
                0, 0, 0, 0,
                $newWidth,
                $newHeight,
                $width,
                $height
            );

            // Simpan hasil compress
            $folder = 'jurnal-photo/' . now()->format('Y-m');
            $filename = uniqid('jurnal_') . '.jpg';

            ob_start();
            imagejpeg($canvas, null, 75); // QUALITY 75%
            $imageData = ob_get_clean();

            \Storage::disk('public')->put($folder . '/' . $filename, $imageData);

            imagedestroy($source);
            imagedestroy($canvas);

            $validated['dokumentasi'] = $folder . '/' . $filename;
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

   public function exportMine(Request $request)
    {
        return Excel::download(
            new MyJurnalsExport(
                auth()->id(),
                $request->tanggal_awal,
                $request->tanggal_akhir
            ),
            'jurnal_saya_' . now()->format('Y-m-d') . '.xlsx'
        );
    }


    public function exportAll(Request $request)
    {
        return Excel::download(
            new AllJurnalsExport(
                $request->tanggal_awal,
                $request->tanggal_akhir
            ),
            'semua_jurnal_' . now()->format('Y-m-d') . '.xlsx'
        );
    }

}