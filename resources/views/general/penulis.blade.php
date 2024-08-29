@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Penulis')

@section('main')
    @if ($action == 'show')
        @section('content_subtitle', 'Daftar penulis buku')
        <div>
            <div class="card shadow-sm py-2 px-3">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Penulis</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>PNL123</td>
                            <td>John Doe</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>PNL124</td>
                            <td>East Robertson</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>PNL125</td>
                            <td>Mark Robert</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>PNL126</td>
                            <td>Tere Liye</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="create" class="btn btn-primary my-3">Tambah Penulis</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah penulis')
    <div class="mb-5">
        <form action="">
            <div>
                <label for="nama_penulis" class="form-label">
                    Nama Penulis *
                </label>
                <input type="text" class="form-control" id="nama_penulis" name="nama_penulis" required />
            </div>
            <div class="mt-4">
                <label for="birth" class="form-label">
                    Tgl Lahir
                </label>
                <input type="text" class="form-control" id="birth" name="birth" />
            </div>
            <div class="mt-4">
                <label for="address" class="form-label">
                    Alamat
                </label>
                <input type="text" class="form-control" id="address" name="address" />
            </div>
            <div class="mt-4">
                <label for="biography" class="form-label">
                    Biodata Penulis
                </label>
                <textarea type="text" class="form-control" id="biography" name="biography"></textarea>
            </div>
            <div class="mt-4">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar Profil Penulis</label>
                    <input class="form-control" type="file" id="formFile" name="formFile" />
                </div>
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambah Penulis" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif($action == 'edit')
    @section('content_subtitle', 'Form edit penulis')
    <div class="mb-5">
        <form action="">
            <div>
                <label class="form-label"> ID Penulis </label>
                <input value="{{ $editID }}" type="text" class="form-control" disabled />
            </div>
            <div class="mt-4">
                <label for="edit_nama_penulis" class="form-label">
                    Nama Penulis *
                </label>
                <input type="text" class="form-control" id="edit_nama_penulis" name="edit_nama_penulis" required />
            </div>
            <div class="mt-4">
                <label for="edit_birth" class="form-label">
                    Tgl Lahir
                </label>
                <input type="text" class="form-control" id="edit_birth" name="edit_birth" />
            </div>
            <div class="mt-4">
                <label for="edit_address" class="form-label">
                    Alamat
                </label>
                <input type="text" class="form-control" id="edit_address" name="edit_address" />
            </div>
            <div class="mt-4">
                <label for="edit_biography" class="form-label">
                    Biodata Penulis
                </label>
                <textarea type="text" class="form-control" id="edit_biography" name="edit_biography"></textarea>
            </div>
            <div class="mt-4">
                <div class="mb-3">
                    <label for="formFileEdit" class="form-label">Gambar Profil Penulis</label>
                    <input class="form-control" type="file" id="formFileEdit" name="formFileEdit" />
                </div>
            </div>
            <div class="mt-4">
                <input type="submit" value="Edit Penulis" class="btn btn-primary" />
            </div>
        </form>
    </div>
@endif
@endsection
