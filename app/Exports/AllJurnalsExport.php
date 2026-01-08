<?php

namespace App\Exports;

use App\Models\Jurnal;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AllJurnalsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function collection()
    {
        return Jurnal::with('user')
            ->orderBy('tanggal_kbm', 'asc')
            ->get()
            ->map(function ($jurnal) {

                $fotoUrl = $jurnal->dokumentasi
                    ? asset('storage/' . $jurnal->dokumentasi)
                    : '';

                return [
                    'Tanggal'        => optional($jurnal->tanggal_kbm)->format('d-m-Y'),
                    'Jam Mulai'      => $jurnal->jam_mulai,
                    'Jam Selesai'    => $jurnal->jam_selesai,
                    'Kelas'          => $jurnal->kelas,
                    'Guru'           => optional($jurnal->user)->name,
                    'Mata Pelajaran' => $jurnal->mata_pelajaran,
                    'Materi'         => $jurnal->materi,
                    'Kegiatan'       => $jurnal->kegiatan,
                    'Foto'           => $fotoUrl,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Jam Mulai',
            'Jam Selesai',
            'Kelas',
            'Guru',
            'Mata Pelajaran',
            'Materi',
            'Kegiatan',
            'Foto',
        ];
    }
}
