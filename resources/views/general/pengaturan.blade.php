@extends('template.layout')

@section('title', 'Pengaturan - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Pengaturan ' . ($level == 'admin' ? 'Administrator' : ''))
@section('content_subtitle', 'Pengaturan akun ' . ($level == 'admin' ? 'admin' : 'siswa'))

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('action.update.profile') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row gap-3">
            <div class="col-12 col-md-4 form-group">
                <label for="user_nama" class="form-label">
                    Nama *</label>
                <input value="{{ $user->user_nama }}" type="text" name="user_nama" id="user_nama" class="form-control"
                    placeholder="Masukkan nama panjang" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="user_username" class="form-label">Username *</label>
                <input value="{{ $user->user_username }}" type="text" name="user_username" id="user_username"
                    class="form-control" placeholder="Masukkan username" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="user_alamat" class="form-label">Alamat *</label>
                <input value="{{ $user->user_alamat }}" type="text" name="user_alamat" id="user_alamat"
                    class="form-control" placeholder="Masukkan alamat" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="user_notelp" class="form-label">No Hp *</label>
                <input value="{{ $user->user_notelp }}" type="text" name="user_notelp" id="user_notelp"
                    class="form-control" placeholder="Masukkan nomor telp" />
            </div>
            <div class="col-12 col-md-4 form-group">
                <label for="user_email" class="form-label">Email *</label>
                <input value="{{ $user->user_email }}" type="email" name="user_email" id="user_email" class="form-control"
                    placeholder="Masukkan email" />
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
