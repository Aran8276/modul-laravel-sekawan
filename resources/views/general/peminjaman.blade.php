@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Peminjaman')

@section('main')
    @if ($action == 'show')
        @section('content_subtitle', 'Daftar kategori buku')
        <div>
            <div class="card shadow-sm py-2 px-3">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Peminjam</th>
                            <th scope="col">Buku</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tgl Pinjam</th>
                            <th scope="col">Tgl Kembali</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Tere Liye - Buku 1</td>
                            <td>
                                <div class="py-2">
                                    <span class="bg-danger px-3 py-2 text-white rounded-pill">MEMINJAM</span>
                                </div>
                            </td>
                            <td>2024-08-25</td>
                            <td></td>
                            <td><a href="edit?id=IDIniAkanTampilDiParameterURL">Selesaikan</a></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>
                                Tere Liye - Cara membuat website di
                                Laravel
                            </td>
                            <td>
                                <div class="py-2">
                                    <span class="bg-danger px-3 py-2 text-white rounded-pill">MEMINJAM</span>
                                </div>
                            </td>
                            <td>2024-08-25</td>
                            <td></td>
                            <td><a href="edit?id=IDIniAkanTampilDiParameterURL">Selesaikan</a></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry the Bird</td>
                            <td>
                                Haynes Manual - Repair Manuals &
                                Guides For Honda Accord 2003 - 2012
                            </td>
                            <td>
                                <div class="py-2">
                                    <span class="bg-success px-3 py-2 text-white rounded-pill">SELESAI</span>
                                </div>
                            </td>
                            <td>2024-08-25</td>
                            <td>2024-08-27</td>
                            <td><a href="#">Hapus</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="create" class="btn btn-primary my-3">Buat Peminjaman</a>
            <a href="#" class="btn btn-warning mx-3">Hapus yang Selesai</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah kategori')
    <div class="mb-5">
        <form action="">
            <div class="mt-4">
                <label for="id_peminjam" class="form-label">ID Peminjam</label>
                <input id="id_peminjam" value="Larry the Bird" type="text" class="form-control" />
            </div>
            <div class="mt-4">
                <label class="form-label" for="name"> Nama Peminjam</label>
                <input value="Larry the Bird" id="name" type="text" class="form-control" />
            </div>
            <div class="mt-4">
                <label for="fine_amt" class="form-label">
                    Denda
                </label>

                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="text" class="form-control" id="fine_amt" name="fine_amt" />
                </div>
            </div>
            <div class="mt-4">
                <label for="fine_note" class="form-label">
                    Catatan Denda
                </label>
                <textarea type="text" class="form-control" style="height: 100px" id="fine_note" name="fine_note"></textarea>
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambahkan Peminjaman" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif ($action == 'edit')
    <form action="">
        <label class="form-label"> Nama Peminjam</label>
        <input value="Larry the Bird (akan dicocokan dgn ID di controller backend: {{ $editID }} )" type="text"
            class="form-control" disabled />
        <div class="mt-4">
            <label for="fine_amt" class="form-label">
                Denda
            </label>

            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control" id="fine_amt" name="fine_amt" />
            </div>
        </div>
        <div class="mt-4">
            <label for="fine_note" class="form-label">
                Catatan Denda
            </label>
            <textarea type="text" class="form-control" style="height: 100px" id="fine_note" name="fine_note"></textarea>
        </div>
        <div class="mt-4">
            <input type="submit" value="Selesaikan Peminjaman" class="btn btn-primary" />
        </div>
    </form>
@endif
@endsection
