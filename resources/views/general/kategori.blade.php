@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Kategori')

@section('main')
    @if ($action == 'show')
        @section('content_subtitle', 'Daftar kategori buku')
        <div>
            <div class="card shadow-sm py-2 px-3">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Kategori</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>KAT123</td>
                            <td>
                                <button type="button" class="btn btn-outline-dark mx-auto">
                                    Novel
                                </button>
                            </td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>KAT124</td>
                            <td>
                                <button type="button" class="btn btn-outline-dark mx-auto">
                                    Komik
                                </button>
                            </td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>KAT125</td>
                            <td>
                                <button type="button" class="btn btn-outline-dark mx-auto">
                                    Anak-anak
                                </button>
                            </td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>KAT126</td>
                            <td>
                                <button type="button" class="btn btn-outline-dark mx-auto">
                                    Petunjuk manual
                                </button>
                            </td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="create" class="btn btn-primary my-3">Buat Kategori</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah kategori')
    <div class="mb-5">
        <form action="">
            <div>
                <label for="nama_kategori" class="form-label">
                    Nama Kategori *
                </label>
                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required />
            </div>
            <div class="mt-4">
                <label for="deskripsi_kategori" class="form-label">
                    Deskripsi Kategori *
                </label>
                <input type="text" class="form-control" id="deskripsi_kategori" name="deskripsi_kategori" required />
            </div>
            <div class="mt-4">
                <input type="submit" value="Buat Kategori" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif($action == 'edit')
    @section('content_subtitle', 'Form edit kategori')
    <div class="mb-5">
        <form action="">
            <div>
                <label class="form-label"> ID Kategori </label>
                <input type="text" value="{{ $editID }}" class="form-control" disabled />
            </div>
            <div class="mt-4">
                <label for="nama_kategori_update" class="form-label">
                    Nama Kategori *
                </label>
                <input type="text" class="form-control" id="nama_kategori_update" name="nama_kategori_update"
                    required />
            </div>
            <div class="mt-4">
                <label for="deskripsi_kategori_update" class="form-label">
                    Deskripsi Kategori *
                </label>
                <input type="text" class="form-control" id="deskripsi_kategori_update"
                    name="deskripsi_kategori_update" required />
            </div>
            <div class="mt-4">
                <input type="submit" value="Edit Kategori" class="btn btn-primary" />
            </div>
        </form>
    </div>
@endif
@endsection
