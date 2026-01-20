<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        

        <!-- Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <div class="modal fade" id="modalExportMine">
            <div class="modal-dialog">
                <div class="modal-content">

                <form action="{{ route('jurnals.export.mine') }}" method="GET">
                    <div class="modal-header">
                    <h5 class="modal-title">Export Jurnal Saya</h5>
                    </div>

                    <div class="modal-body">
                    <label>Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" class="form-control">

                    <label class="mt-2">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control">
                    </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                </form>

                </div>
            </div>
        </div>

        <div class="modal fade" id="modalExportAll">
            <div class="modal-dialog">
                <div class="modal-content">

                <form action="{{ route('jurnals.export.all') }}" method="GET">
                    <div class="modal-header">
                    <h5 class="modal-title">Export Semua Jurnal</h5>
                    </div>

                    <div class="modal-body">
                    <label>Dari Tanggal</label>
                    <input type="date" name="tanggal_awal" class="form-control">

                    <label class="mt-2">Sampai Tanggal</label>
                    <input type="date" name="tanggal_akhir" class="form-control">
                    </div>

                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Export</button>
                    </div>
                </form>

                </div>
            </div>
        </div>

    </body>
</html>
