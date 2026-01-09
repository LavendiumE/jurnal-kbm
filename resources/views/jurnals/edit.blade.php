@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6 px-4">

    <h2 class="text-xl font-semibold mb-6">
        Edit Jurnal KBM
    </h2>

    <form action="{{ route('jurnals.update', $jurnal->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white shadow rounded-lg p-6 space-y-4">

        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium">Tanggal KBM</label>
            <input type="date" name="tanggal_kbm"
                   value="{{ $jurnal->tanggal_kbm->format('Y-m-d') }}"
                   class="mt-1 w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium">Kelas</label>
            <input type="text" name="kelas"
                   value="{{ $jurnal->kelas }}"
                   class="mt-1 w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium">Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran"
                   value="{{ $jurnal->mata_pelajaran }}"
                   class="mt-1 w-full border rounded px-3 py-2"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium">Materi</label>
            <textarea name="materi"
                      class="mt-1 w-full border rounded px-3 py-2"
                      rows="3"
                      required>{{ $jurnal->materi }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium">Kegiatan</label>
            <textarea name="kegiatan"
                      class="mt-1 w-full border rounded px-3 py-2"
                      rows="2">{{ $jurnal->kegiatan }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Jam Mulai</label>
                <input type="time" name="jam_mulai"
                       value="{{ $jurnal->jam_mulai }}"
                       class="mt-1 w-full border rounded px-3 py-2"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium">Jam Selesai</label>
                <input type="time" name="jam_selesai"
                       value="{{ $jurnal->jam_selesai }}"
                       class="mt-1 w-full border rounded px-3 py-2"
                       required>
            </div>
        </div>

        {{-- KEHADIRAN --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium">Hadir</label>
                <input type="number" name="hadir"
                    value="{{ $jurnal->hadir }}"
                    min="0"
                    class="mt-1 w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block text-sm font-medium">Izin</label>
                <textarea name="izin" rows="3"
                        class="mt-1 w-full border px-3 py-2 rounded">{{ $jurnal->izin }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Sakit</label>
                <textarea name="sakit" rows="3"
                        class="mt-1 w-full border px-3 py-2 rounded">{{ $jurnal->sakit }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Alfa</label>
                <textarea name="alfa" rows="3"
                        class="mt-1 w-full border px-3 py-2 rounded">{{ $jurnal->alfa }}</textarea>
            </div>
        </div>


        {{-- FOTO --}}
        <div>
            <label class="block text-sm font-medium mb-1">
                Dokumentasi Kegiatan
            </label>

            @if ($jurnal->dokumentasi)
                <img src="{{ asset('storage/' . $jurnal->dokumentasi) }}"
                     class="w-40 rounded mb-2 border">
            @endif

            <input type="file" name="dokumentasi" accept="image/*">
            <p class="text-xs text-gray-500 mt-1">
                Kosongkan jika tidak ingin mengganti foto
            </p>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('jurnals.index') }}"
               class="px-4 py-2 border rounded">
                Batal
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update
            </button>
        </div>

    </form>

</div>
@endsection
