@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">

    <h2 class="text-2xl font-semibold mb-6">
        Tambah Jurnal KBM
    </h2>

    {{-- ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jurnals.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white shadow rounded-lg p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium">Tanggal KBM</label>
            <input type="date" name="tanggal_kbm"
                   value="{{ old('tanggal_kbm') }}"
                   class="mt-1 w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Kelas</label>
            <input type="text" name="kelas"
                   value="{{ old('kelas') }}"
                   class="mt-1 w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Mata Pelajaran</label>
            <input type="text" name="mata_pelajaran"
                   value="{{ old('mata_pelajaran') }}"
                   class="mt-1 w-full border rounded px-3 py-2" required>
        </div>

        <div>
            <label class="block text-sm font-medium">Materi</label>
            <textarea name="materi" rows="3"
                      class="mt-1 w-full border rounded px-3 py-2"
                      required>{{ old('materi') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium">Kegiatan</label>
            <textarea name="kegiatan" rows="2"
                      class="mt-1 w-full border rounded px-3 py-2">{{ old('kegiatan') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai"
                       value="{{ old('jam_mulai') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
            <div>
                <label>Jam Selesai</label>
                <input type="time" name="jam_selesai"
                       value="{{ old('jam_selesai') }}"
                       class="w-full border rounded px-3 py-2" required>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium">Hadir</label>
                <input type="number" name="hadir" min="0"
                    value="{{ old('hadir', 0) }}"
                    class="mt-1 w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm font-medium">Izin</label>
                <textarea name="izin" rows="3"
                        class="mt-1 w-full border rounded px-3 py-2"
                        placeholder="Nama murid izin (pisahkan dengan koma / baris baru)">{{ old('izin') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Sakit</label>
                <textarea name="sakit" rows="3"
                        class="mt-1 w-full border rounded px-3 py-2"
                        placeholder="Nama murid sakit">{{ old('sakit') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium">Alfa</label>
                <textarea name="alfa" rows="3"
                        class="mt-1 w-full border rounded px-3 py-2"
                        placeholder="Nama murid alfa">{{ old('alfa') }}</textarea>
            </div>
        </div>


        <div>
            <label>Dokumentasi Kegiatan</label>
            <input type="file" name="dokumentasi" accept="image/*">
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('jurnals.index') }}"
               class="px-4 py-2 border rounded">
                Batal
            </a>
            <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection
