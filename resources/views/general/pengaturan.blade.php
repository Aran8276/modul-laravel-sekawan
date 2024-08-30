@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Pengaturan ' . ($level == 'admin' ? 'Administrator' : ''))
@section('content_subtitle', 'Pengaturan akun ' . ($level == 'admin' ? 'admin' : 'siswa'))

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="">
        <div class="row gap-3">
            <div class="col-12 col-md-4 form-group">
                <label for="name" class="form-label">
                    Nama *</label>
                <input type="text" name="name" id="name" class="form-control"
                    placeholder="Masukkan nama panjang" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="username" class="form-label">Username *</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="address" class="form-label">Alamat *</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Masukkan alamat" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="phone" class="form-label">No Hp *</label>
                <input type="text" name="phone" id="phone" class="form-control"
                    placeholder="Masukkan nomor telp" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="email" class="form-label">Email *</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="password" class="form-label">Password *</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Masukkan password" />
            </div>
        </div>
        <div class="row my-3">
            <div class="col-12 col-md-4">
                <button class="btn btn-primary">
                    Update Profil
                </button>
            </div>
        </div>
    </form>

@endsection
