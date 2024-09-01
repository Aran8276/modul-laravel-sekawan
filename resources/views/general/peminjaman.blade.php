@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Peminjaman')

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                        @foreach ($data as $index => $peminjaman)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $peminjaman['user']['user_username'] }}</td>
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
                        @endforeach
                        {{-- <tr>
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
                        </tr> --}}
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
@elseif($action == 'siswa')
    <div class="card shadow-sm py-2 px-3">
        <table id="datatablesSimple">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Buku</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tgl Pinjam</th>
                    <th scope="col">Tgl Kembali</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $peminjaman)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td><a href="#">{{ $peminjaman['buku_content']['buku_judul'] }}</a></td>
                        <td>
                            @if ($peminjaman['peminjaman_content']['peminjaman_statuskembali'] == 1)
                                <div class="py-2">
                                    <span class="bg-success px-3 py-2 text-white rounded-pill">SELESAI</span>
                                </div>
                            @else
                                <div class="py-2">
                                    <span class="bg-danger px-3 py-2 text-white rounded-pill">MEMINJAM</span>
                                </div>
                            @endif
                        </td>
                        <td>{{ $peminjaman['peminjaman_content']['peminjaman_tglpinjam'] }}</td>
                        <td>
                            {{-- @if ($peminjaman['peminjaman_content']['peminjaman_statuskembali'] == 1)
                                <div class="py-2">
                                    <span class="bg-success px-3 py-2 text-white rounded-pill">SELESAI</span>
                                </div>
                            @else
                                <div class="py-2">
                                    <span class="bg-danger px-3 py-2 text-white rounded-pill">MEMINJAM</span>
                                </div>
                            @endif --}}
                            @if ($peminjaman['peminjaman_content']['peminjaman_statuskembali'] == 1)
                                <span>{{ $peminjaman['peminjaman_content']['peminjaman_tglkembali'] }}</span>
                            @else
                                <span>-</span>
                            @endif


                        </td>
                    </tr>
                @endforeach
                {{-- <tr>
                    <th scope="row">2</th>
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
                </tr>
                <tr>
                    <th scope="row">3</th>
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
                </tr> --}}
            </tbody>
        </table>
    </div>
@endif
@endsection
