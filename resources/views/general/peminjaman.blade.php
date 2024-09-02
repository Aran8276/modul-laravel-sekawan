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
                            <th scope="col">Denda</th>
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
                                <td>{{ $peminjaman['peminjaman_denda'] }}</td>
                                <td>{{ $peminjaman['buku'][0]['buku_judul'] }}</td>
                                <td>
                                    @if ($peminjaman['peminjaman_statuskembali'] == 1)
                                        <div>
                                            <h5><span class="badge text-bg-success">SELESAI</span></h5>
                                        </div>
                                    @else
                                        <div>
                                            <h5><span class="badge text-bg-danger">MEMINJAM</span></h5>
                                        </div>
                                    @endif
                                </td>
                                <td>2024-08-25</td>

                                @if ($peminjaman['peminjaman_statuskembali'] == 1)
                                    <td>{{ $peminjaman['peminjaman_tglkembali'] }}</td>
                                @else
                                    <td>-</td>
                                @endif

                                @if ($peminjaman['peminjaman_statuskembali'] == 1)
                                    <td><a href="delete?id={{ $peminjaman['peminjaman_id'] }}">Hapus</a></td>
                                @else
                                    <td><a href="edit?id={{ $peminjaman['peminjaman_id'] }}">Selesaikan</a></td>
                                @endif
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
                                <div>
                                    <h5><span class="badge text-bg-danger">MEMINJAM</span></h5>
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
                                <div>
                                    <h5><span                                         class="badge text-bg-success">SELESAI</span>                                </h5>
                                </div>
                            </td>
                            <td>2024-08-25</td>
                            <td>2024-08-27</td>
                            <td><a href="#">Hapus</a></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
            <a href="create" class="btn btn-primary mx-1 my-3">Buat Peminjaman</a>
            {{-- <a href="#" class="btn btn-secondary mx-1 my-3">Perbersar Table</a> --}}
            <button href="create" class="btn btn-secondary my-3" data-bs-toggle="modal" data-bs-target="#modalTable">
                Perbesar Table
            </button>
            <div class="modal fade" id="modalTable" tabindex="-1" aria-labelledby="modalTable" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalTable">Table buku</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table id="datatablesSimple2">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Peminjam</th>
                                        <th scope="col">Denda</th>
                                        <th scope="col">Catatan</th>
                                        <th scope="col">No Telp Peminjam</th>
                                        <th scope="col">Buku</th>
                                        <th scope="col">ISBN</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Tgl Pinjam</th>
                                        <th scope="col">Tgl Kembali</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $peminjaman)
                                        <tr>
                                            <th scope="row">{{ $index + 1 }}</th>
                                            <td>{{ $peminjaman['peminjaman_id'] }}</td>
                                            <td>{{ $peminjaman['user']['user_username'] }}</td>
                                            <td>{{ $peminjaman['peminjaman_denda'] }}</td>
                                            <td>{{ $peminjaman['peminjaman_note'] }}</td>
                                            <td>{{ $peminjaman['user']['user_notelp'] }}</td>
                                            <td>{{ $peminjaman['buku'][0]['buku_judul'] }}</td>
                                            <td>{{ $peminjaman['buku'][0]['buku_isbn'] }}</td>
                                            @if ($peminjaman['peminjaman_statuskembali'] == 1)
                                                <td>
                                                    <h5><span class="badge text-bg-success">SELESAI</span></h5>
                                                </td>
                                            @else
                                                <td>
                                                    <h5><span class="badge text-bg-danger">MEMINJAM</span></h5>
                                                </td>
                                            @endif

                                            <td>{{ $peminjaman['peminjaman_tglpinjam'] }}</td>

                                            @if ($peminjaman['peminjaman_statuskembali'] == 1)
                                                <td>{{ $peminjaman['peminjaman_tglkembali'] }}</td>
                                            @else
                                                <td>-</td>
                                            @endif
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
                                            <div>
                                                <h5><span class="badge text-bg-danger">MEMINJAM</span></h5>
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
                                            <div>
                                                <h5><span                                         class="badge text-bg-success">SELESAI</span>                                </h5>
                                            </div>
                                        </td>
                                        <td>2024-08-25</td>
                                        <td>2024-08-27</td>
                                        <td><a href="#">Hapus</a></td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-warning mx-1 my-3" data-bs-toggle="modal" data-bs-target="#modalDelete">
                Hapus yang Selesai
            </button>
            <!-- Button trigger modal -->

            <!-- Modal Content -->
            <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Table Action Href Array Content -->
                            Apakah anda yakin ingin menghapus semua peminjaman yang selesai?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <a href="delete-index" class="btn btn-danger">Konfirmasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah kategori')
    <div class="mb-5">
        <form action={{ route('action.peminjaman.create') }} method="POST">
            @csrf
            <div class="mt-4">
                <label for="peminjaman_user_id" class="form-label">Peminjam</label>
                <select class="form-select" id="peminjaman_user_id" name="peminjaman_user_id" required>
                    <option selected>
                        -Pilih User Peminjam-
                    </option>
                    @foreach ($data['user'] as $user)
                        <option value="{{ $user['user_id'] }}">
                            {{ $user['user_username'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <label for="peminjaman_detail_buku_id" class="form-label">Peminjam</label>
                <select class="form-select" id="peminjaman_detail_buku_id" name="peminjaman_detail_buku_id" required>
                    <option selected>
                        -Pilih Buku-
                    </option>
                    @foreach ($data['buku'] as $buku)
                        <option value="{{ $buku['buku_id'] }}">
                            {{ $buku['buku_judul'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambahkan Peminjaman" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif ($action == 'edit')
    <form action={{ route('action.peminjaman.update', ['id' => $editID]) }} method="POST">
        @csrf
        @method('PUT')
        <label class="form-label">Nama Peminjam</label>
        <input value="{{ $data[0]['user']['user_nama'] }} ({{ $data[0]['user']['user_username'] }})" type="text"
            class="form-control" disabled />
        <div class="mt-4">
            <label for="peminjaman_denda" class="form-label">
                Denda
            </label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" class="form-control" id="peminjaman_denda" name="peminjaman_denda" />
            </div>
            @error('peminjaman_denda')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-4">
            <label for="fine_note" class="form-label">
                Catatan Denda
            </label>
            <textarea type="text" class="form-control" style="height: 100px" id="peminjaman_note" name="peminjaman_note"></textarea>
            @error('peminjaman_note')
                <span class="text-danger">{{ $message }}</span>
            @enderror
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
                    <th scope="col">Denda</th>
                    <th scope="col">Catatan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tgl Pinjam</th>
                    <th scope="col">Tgl Kembali</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $peminjaman)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>{{ $peminjaman['buku_content']['buku_judul'] }}</td>
                        <td>
                            @if ($peminjaman['peminjaman_content']['peminjaman_statuskembali'] == 1)
                                <h5><span
                                        class="badge text-bg-danger">{{ $peminjaman['peminjaman_content']['peminjaman_denda'] }}</span>
                                </h5>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>
                            @if (
                                $peminjaman['peminjaman_content']['peminjaman_statuskembali'] == 1 &&
                                    !$peminjaman['peminjaman_content']['peminjaman_denda'] == '')
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#catatanModal_{{ $peminjaman['peminjaman_detail_peminjaman_id'] }}">
                                    Lihat Catatan
                                </button>

                                <div class="modal fade"
                                    id="catatanModal_{{ $peminjaman['peminjaman_detail_peminjaman_id'] }}"
                                    tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Catatan</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <span>Denda: </span>
                                                    <span>{{ $peminjaman['peminjaman_content']['peminjaman_denda'] }}</span>
                                                </div>
                                                <div class="mt-3">
                                                    <span>Catatan:</span>
                                                    <span>{{ $peminjaman['peminjaman_content']['peminjaman_note'] }}</span>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                        <td>
                            @if ($peminjaman['peminjaman_content']['peminjaman_statuskembali'] == 1)
                                <div>
                                    <h5><span class="badge text-bg-success">SELESAI</span></h5>
                                </div>
                            @else
                                <div>
                                    <h5><span class="badge text-bg-danger">MEMINJAM</span></h5>
                                </div>
                            @endif
                        </td>
                        <td>{{ $peminjaman['peminjaman_content']['peminjaman_tglpinjam'] }}</td>
                        <td>
                            {{-- @if ($peminjaman['peminjaman_content']['peminjaman_statuskembali'] == 1)
                                <div>
                                    <h5><span                                         class="badge text-bg-success">SELESAI</span>                                </h5>
                                </div>
                            @else
                                <div>
                                    <h5><span class="badge text-bg-danger">MEMINJAM</span></h5>
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
                        <div>
                            <h5><span class="badge text-bg-danger">MEMINJAM</span></h5>
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
                        <div>
                            <h5><span                                         class="badge text-bg-success">SELESAI</span>                                </h5>
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

{{-- 
1. Menentukan Topik atau Tema
2. Menentukan Tujuan Penulisan
3. Mengumpulkan Data atau Informasi
4. Membangun Kerangka Karangan
5. Mengembangkan Paragraf
6. Menyusun Kesimpulan --}}
