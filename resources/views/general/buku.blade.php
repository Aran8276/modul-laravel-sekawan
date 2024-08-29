@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Buku')

@section('main')
    @if ($action == 'show')
        @section('content_subtitle', 'Daftar buku')
        <div>
            <div class="card shadow-sm py-2 px-3">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Penulis Buku</th>
                            <th>Penerbit Buku</th>
                            <th>Tahun Terbit</th>
                            <th>Kategori Buku</th>
                            <th>Rak Buku</th>
                            <th>ISBN</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Bulan</td>
                            <td>Tere Liye</td>
                            <td>Gramedia</td>
                            <td>2018</td>
                            <td>Fiksi</td>
                            <td>L-4</td>
                            <td>12345464564564</td>
                            <td style="text-align: center">
                                <a class="px-2" href="edit?id=IDIniAkanTampilDiParameterURL">Edit</a>
                                <a class="text-danger" href="edit?id=IDIniAkanTampilDiParameterURL">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="create" class="btn btn-primary my-3">Buat Buku</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah buku')
    <div class="mb-5">
        <form action="">
            <div class="row gap-3">
                <div class="col-12 col-md-4 form-group">
                    <label for="judul_buku" class="form-label">Judul Buku *</label>
                    <input type="text" name="judul_buku" id="judul_buku" class="form-control"
                        placeholder="Masukkan judul buku" />
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="penulis_buku" class="form-label">Penulis Buku *</label>
                    <select name="penulis_buku" id="penulis_buku" class="form-control">
                        <option selected>
                            -Pilih Penulis Buku-
                        </option>
                        <option value="Tere Liye">
                            Tere Liye
                        </option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="penerbit_buku" class="form-label">Penerbit Buku *</label>
                    <select name="penerbit_buku" id="penerbit_buku" class="form-control">
                        <option selected>
                            -Pilih Penerbit Buku-
                        </option>
                        <option value="Gramedia">
                            Gramedia
                        </option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="tahun_terbit" class="form-label">Tahun Terbit *</label>
                    <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control"
                        placeholder="Masukkan tahun terbit" />
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="kategori_buku" class="form-label">Kategori Buku *</label>
                    <select name="kategori_buku" id="kategori_buku" class="form-control">
                        <option selected>
                            -Pilih Kategori Buku-
                        </option>
                        <option value="Fiksi">Fiksi</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="rak_buku" class="form-label">Rak Buku *</label>
                    <select name="rak_buku" id="rak_buku" class="form-control">
                        <option selected>
                            -Pilih Rak Buku-
                        </option>
                        <option value="4-L">4-L</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="isbn" class="form-label">Nomor ISBN *</label>
                    <input type="text" name="isbn" id="isbn" class="form-control"
                        placeholder="Masukkan nomor ISBN" />
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12 col-md-4">
                    <button class="btn btn-primary">
                        Tambahkan
                    </button>
                </div>
            </div>
        </form>
    </div>
@elseif($action == 'edit')
    @section('content_subtitle', 'Form edit buku')
    <div class="mb-5">
        <form action="">
            <div class="row gap-3">
                <div class="col-12 col-md-4 form-group">
                    <label for="id" class="form-label">ID Buku </label>
                    <input type="text" name="judul_buku_edit" id="id" class="form-control"
                        value="{{ $editID }}" disabled />
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="judul_buku_edit" class="form-label">Judul Buku *</label>
                    <input type="text" name="judul_buku_edit" id="judul_buku_edit" class="form-control"
                        placeholder="Masukkan judul buku" />
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="penulis_buku_edit" class="form-label">Penulis Buku *</label>
                    <select name="penulis_buku_edit" id="penulis_buku_edit" class="form-control">
                        <option selected>
                            -Pilih Penulis Buku-
                        </option>
                        <option value="Tere Liye">
                            Tere Liye
                        </option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="penerbit_buku_edit" class="form-label">Penerbit Buku *</label>
                    <select name="penerbit_buku_edit" id="penerbit_buku_edit" class="form-control">
                        <option selected>
                            -Pilih Penerbit Buku-
                        </option>
                        <option value="Gramedia">
                            Gramedia
                        </option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="tahun_terbit_edit" class="form-label">Tahun Terbit *</label>
                    <input type="text" name="tahun_terbit_edit" id="tahun_terbit_edit" class="form-control"
                        placeholder="Masukkan tahun terbit" />
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="kategori_buku_edit" class="form-label">Kategori Buku *</label>
                    <select name="kategori_buku_edit" id="kategori_buku_edit" class="form-control">
                        <option selected>
                            -Pilih Kategori Buku-
                        </option>
                        <option value="Fiksi">Fiksi</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="rak_buku_edit" class="form-label">Rak Buku *</label>
                    <select name="rak_buku_edit" id="rak_buku_edit" class="form-control">
                        <option selected>
                            -Pilih Rak Buku-
                        </option>
                        <option value="4-L">4-L</option>
                    </select>
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="isbn_edit" class="form-label">Nomor ISBN *</label>
                    <input type="text" name="isbn_edit" id="isbn_edit" class="form-control"
                        placeholder="Masukkan nomor ISBN" />
                </div>
            </div>
            <div class="row my-3">
                <div class="col-12 col-md-4">
                    <button class="btn btn-primary">
                        Edit Buku
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif
@endsection
