@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Penerbit')

@section('main')
    @if ($action == 'show')
        @section('content_subtitle', 'Daftar penerbit buku')
        <div>
            <div class="card shadow-sm py-2 px-3">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Penerbit</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>PNB123</td>
                            <td>Erlangga</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>PNB124</td>
                            <td>Erlang Elixir</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>PNB125</td>
                            <td>Hayati</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>PNB126</td>
                            <td>Lintas Jatim</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="create" class="btn btn-primary my-3">Tambah Penerbit</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah penerbit')
    <div class="mb-5">
        <form action="">
            <div>
                <label for="nama_penerbit" class="form-label">
                    Nama Penerbit *
                </label>
                <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required />
            </div>
            <div class="mt-4">
                <label for="biography" class="form-label">
                    Biodata Penerbit
                </label>
                <textarea type="text" class="form-control" id="biography" name="biography"></textarea>
            </div>
            <div class="mt-4">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Gambar Profil Penerbit</label>
                    <input class="form-control" type="file" id="formFile" name="formFile" />
                </div>
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambah Penerbit" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif($action == 'edit')
    @section('content_subtitle', 'Form edit penerbit')
    <div class="mb-5">
        <form action="">
            <div>
                <label class="form-label"> ID Penerbit </label>
                <input value={{ $editID }} type="text" class="form-control" disabled />
            </div>
            <div class="mt-4">
                <label for="edit_nama_penerbit" class="form-label">
                    Nama Penerbit *
                </label>
                <input type="text" class="form-control" id="edit_nama_penerbit" name="edit_nama_penerbit" required />
            </div>
            <div class="mt-4">
                <label for="edit_biography" class="form-label">
                    Biodata Penerbit
                </label>
                <textarea type="text" class="form-control" id="edit_biography" name="edit_biography"></textarea>
            </div>
            <div class="mt-4">
                <div class="mb-3">
                    <label for="formFileEdit" class="form-label">Gambar Profil Penerbit</label>
                    <input class="form-control" type="file" id="formFileEdit" name="formFileEdit" />
                </div>
            </div>
            <div class="mt-4">
                <input type="submit" value="Edit Penerbit" class="btn btn-primary" />
            </div>
        </form>
    </div>
@endif
@endsection
