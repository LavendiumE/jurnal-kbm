<?php

namespace App\Exports;

use App\Models\Jurnal;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MyJurnalsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected int $userId;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }

    public function collection(): Collection
    {
        return Jurnal::where('user_id', $this->userId)
            ->orderBy('tanggal_kbm', 'asc')
            ->get()
            ->map(function ($jurnal) {

                $fotoUrl = $jurnal->dokumentasi
                    ? asset('storage/' . $jurnal->dokumentasi)
                    : '';

                return [
                    'Tanggal'        => $jurnal->tanggal_kbm->format('d-m-Y'),
                    'Jam Mulai'      => $jurnal->jam_mulai,
                    'Jam Selesai'    => $jurnal->jam_selesai,
                    'Kelas'          => $jurnal->kelas,
                    'Guru'           => $jurnal->guru,
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
            'Kegiatan',
            'Materi',
            'Foto',
        ];
    }
}
