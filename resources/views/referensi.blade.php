<!-- Menggunakan template layout -->
@extends('template.layout')

<!-- section = Bagian yang akan ditampilkan di yield('title') pada `layout.blade.php` -->
<!-- Memasukan data ke tag <title> yang ada di layout.blade.php -->
@section('title', 'Dashboard - Admin Perpustakaan')

<!-- section = Bagian yang akan ditampilkan di yield('header') pada `layout.blade.php` -->
<!-- include = Menampilkan header yang diimpor dari `views/template/navbar/navbar_admin.blade.php` -->
@section('header')
    @include('template.navbar.navbar_admin')
@endsection

<!-- section = Bagian yang akan ditampilkan di yield('main') pada `layout.blade.php` -->
@section('main')
    <div id="layoutSidenav">
        @include('template.sidebar.sidebar_admin')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <!-- Konten akan ada disini -->
                    <h1 class="mt-4">Judul</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Subjudul</li>
                    </ol>
                    <div>Hello World</div>
                    <!-- Konten akan ada disini -->
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Web Perpustakaan 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
