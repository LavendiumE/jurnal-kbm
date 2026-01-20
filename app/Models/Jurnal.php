<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_kbm',
        'kelas',
        'ruang',
        'hadir',
        'izin',
        'sakit',
        'alfa',
        'guru',
        'mata_pelajaran',
        'materi',
        'kegiatan',
        'jam_mulai',
        'jam_selesai',
        'dokumentasi',
    ];

    protected $casts = [
        'tanggal_kbm' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
