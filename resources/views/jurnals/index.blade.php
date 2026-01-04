@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex justify-end items-center text-sm mb-6 divide-x divide-gray-300">

        <!-- Add Jurnal -->
        <a href="{{ route('jurnals.create') }}"
        class="px-4 py-2 text-green-700
                hover:bg-green-50 hover:border hover:border-green-300
                rounded-md transition">
            + Add Jurnal
        </a>

        <!-- Export My Jurnal -->
        <a href="{{ route('jurnals.export.mine') }}"
        class="px-4 py-2 text-blue-700
                hover:bg-blue-50 hover:border hover:border-blue-300
                rounded-md transition">
            Export My Jurnal
        </a>

        <!-- Export All Jurnal -->
        <a href="{{ route('jurnals.export.all') }}"
        class="px-4 py-2 text-slate-700
                hover:bg-slate-100 hover:border hover:border-slate-300
                rounded-md transition">
            Export All Jurnal
        </a>

    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden w-full">

        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-sm text-gray-700">
                <tr>
                    <th class="border px-4 py-3 text-center w-32">Tanggal</th>
                    <th class="border px-4 py-3 text-center w-28">Jam Mulai</th>
                    <th class="border px-4 py-3 text-center w-28">Jam Selesai</th>
                    <th class="border px-4 py-3 text-center w-20">Kelas</th>
                    <th class="border px-4 py-3 text-left w-40">Guru</th>
                    <th class="border px-4 py-3 text-left w-48">Mata Pelajaran</th>
                    <th class="border px-4 py-3 text-left">Materi</th>
                    <th class="border px-4 py-3 text-center w-32">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-sm text-gray-800">
                @forelse ($jurnals as $jurnal)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border px-4 py-3 text-center">
                            {{ $jurnal->tanggal_kbm->format('d-m-Y') }}
                        </td>

                        <td class="border px-4 py-3 text-center">
                            {{ substr($jurnal->jam_mulai, 0, 5) }}
                        </td>

                        <td class="border px-4 py-3 text-center">
                            {{ substr($jurnal->jam_selesai, 0, 5) }}
                        </td>

                        <td class="border px-4 py-3 text-center">
                            {{ $jurnal->kelas }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $jurnal->guru }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $jurnal->mata_pelajaran }}
                        </td>

                        <td class="border px-4 py-3">
                            {{ $jurnal->materi }}
                        </td>

                        <td class="border px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">

                                @can('update', $jurnal)
                                    <a href="{{ route('jurnals.edit', $jurnal->id) }}"
                                    class="text-blue-600 hover:underline">
                                        Edit
                                    </a>
                                @endcan

                                <span class="text-gray-400">|</span>

                                @can('delete', $jurnal)
                                    <form action="{{ route('jurnals.destroy', $jurnal->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin hapus jurnal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="border px-4 py-8 text-center text-gray-500">
                            Belum ada jurnal KBM
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="px-4 py-3 border-t">
            {{ $jurnals->links() }}
        </div>
    </div>

</div>
@endsection
