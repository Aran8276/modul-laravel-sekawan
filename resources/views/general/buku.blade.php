@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Buku')

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($action == 'show')
        @section('content_subtitle', 'Daftar buku')
        <div>
            <div class="card shadow-sm py-2 px-3">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Judul Buku</th>
                            <th>Penulis Buku</th>
                            <th>Rak Buku</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_buku as $index => $buku)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $buku['buku_id'] }}</td>
                                <td>{{ $buku['buku_judul'] }}</td>
                                <td>{{ $buku['buku_penulis'] }}</td>
                                <td>{{ $buku['buku_rak'] }}</td>
                                <td style="text-align: center">
                                    <a class="px-2" href="edit?id={{ $buku['buku_id'] }}">Edit</a>
                                    <a class="text-danger" href="#" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $index + 1 }}">Hapus</a>
                                    <!-- Button trigger modal -->

                                    <!-- Modal Content -->
                                    <div class="modal fade" id="modalDelete{{ $index + 1 }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                        Hapus Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus buku buku
                                                    {{ $buku['buku_judul'] }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <a href="delete?id={{ $buku['buku_id'] }}"
                                                        class="btn btn-danger">Konfirmasi</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div>
                <a href="create" class="btn btn-primary my-3">Buat Buku</a>
                <button href="create" class="btn btn-secondary my-3" data-bs-toggle="modal" data-bs-target="#modalTable">
                    Perbesar Table
                </button>
                <div class="modal fade" id="modalTable" tabindex="-1" aria-labelledby="modalTable" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalTable">Table buku</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table id="datatablesSimple3">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Judul Buku</th>
                                            <th>Penulis Buku</th>
                                            <th>Penerbit Buku</th>
                                            <th>Tahun Terbit</th>
                                            <th>Kategori Buku</th>
                                            <th>Rak Buku</th>
                                            <th>ISBN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_buku as $index => $buku)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $buku['buku_id'] }}</td>
                                                <td>{{ $buku['buku_judul'] }}</td>
                                                <td>{{ $buku['buku_penulis'] }}</td>
                                                <td>{{ $buku['buku_penerbit'] }}</td>
                                                <td>{{ $buku['buku_thnterbit'] }}</td>
                                                <td>{{ $buku['buku_kategori'] }}</td>
                                                <td>{{ $buku['buku_rak'] }}</td>
                                                <td>{{ $buku['buku_isbn'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm py-2 px-3 mt-4">
                <table id="datatablesSimple2">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Rak</th>
                            <th>Lokasi Rak</th>
                            <th>Kapasitas Rak</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- variabel data as index123 => variabel utk akses subdata melalui [''] -->
                        @foreach ($data_rak as $index => $rak)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rak['rak_nama'] }}</td>
                                <td>{{ $rak['rak_lokasi'] }}</td>
                                <td>{{ $rak['rak_kapasitas'] }} buku</td>
                                <td style="text-align: center">
                                    <a class="px-2" href="edit-rak?id={{ $rak['rak_id'] }}">Edit</a>
                                    <a class="text-danger" href="#" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete{{ $index + 1 }}">Hapus</a>
                                    <!-- Button trigger modal -->

                                    <!-- Modal Content -->
                                    <div class="modal fade" id="modalDelete{{ $index + 1 }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus rak buku {{ $rak['rak_nama'] }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <a href="delete-rak?id={{ $rak['rak_id'] }}"
                                                        class="btn btn-danger">Konfirmasi</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                <a href="create-rak" class="btn btn-primary my-3">Tambahkan Rak Buku</a>
            </div>
        </div>
    @elseif($action == 'create-rak')
    @section('content_subtitle', 'Form tambah rak buku')
    <div class="mb-5">
        <form action="{{ route('action.rak.create') }}" method="POST">
            @csrf
            <div>
                <label for="rak_nama" class="form-label">
                    Nama Rak *
                </label>
                <input type="text" class="form-control" id="rak_nama" name="rak_nama" required />
                @error('rak_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="rak_lokasi" class="form-label">
                    Lokasi Rak *
                </label>
                <input type="text" class="form-control" id="rak_lokasi" name="rak_lokasi" required />
                @error('rak_lokasi')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="mt-4">
                <label for="rak_kapasitas" class="form-label">
                    Kapasitas Rak *
                </label>
                <select class="form-select" id="rak_kapasitas" name="rak_kapasitas" required>
                    <option selected>
                        -Pilih Kapasitas Rak-
                    </option>
                    <option value="10">
                        10
                    </option>
                    <option value="15">
                        15
                    </option>
                    <option value="20">
                        20
                    </option>
                    <option value="25">
                        25
                    </option>
                    <option value="30">
                        30
                    </option>
                    <option value="35">
                        35
                    </option>
                    <option value="40">
                        40
                    </option>
                    <option value="45">
                        45
                    </option>
                    <option value="50">
                        50
                    </option>
                </select>
                @error('rak_kapasitas')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambahkan Rak" class="btn btn-primary" />
            </div>

        </form>
    </div>
@elseif($action == 'edit-rak')
    @section('content_subtitle', 'Form edit rak buku')
    <div class="mb-5">
        <form action="{{ route('action.rak.update', ['id' => $editID]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">
                    ID Rak *
                </label>
                <input type="text" class="form-control" disabled value="{{ $editID }}" />
            </div>
            <div class="mt-4">
                <label for="rak_nama" class="form-label">
                    Nama Rak *
                </label>
                <input type="text" class="form-control" id="rak_nama" value="{{ $data_rak->rak_nama }}"
                    name="rak_nama" required />
                @error('rak_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="rak_lokasi" class="form-label">
                    Lokasi Rak *
                </label>
                <input type="text" class="form-control" id="rak_lokasi" value="{{ $data_rak->rak_lokasi }}"
                    name="rak_lokasi" required />
                @error('rak_lokasi')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="mt-4">
                <label for="rak_kapasitas" class="form-label">
                    Kapasitas Rak *
                </label>
                <select class="form-select" id="rak_kapasitas" name="rak_kapasitas">
                    <option value="" {{ $data_rak->rak_kapasitas == '' ? 'selected' : '' }}>
                        -Pilih Kapasitas Rak-
                    </option>
                    @foreach ([10, 15, 20, 25, 30, 35, 40, 45, 50] as $kapasitas)
                        <option value="{{ $kapasitas }}"
                            {{ $data_rak->rak_kapasitas == $kapasitas ? 'selected' : '' }}>
                            {{ $kapasitas }}
                        </option>
                    @endforeach
                </select>
                @error('rak_kapasitas')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="mt-4">
                <input type="submit" value="Edit Rak" class="btn btn-primary" />
            </div>

        </form>
    </div>
@elseif($action == 'create')
    @section('content_subtitle', 'Form edit rak buku')
    <div class="mb-5">
        <form action="{{ route('action.buku.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row gap-3">
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_judul" class="form-label">Judul Buku *</label>
                    <input type="text" name="buku_judul" id="buku_judul" class="form-control"
                        placeholder="Masukkan judul buku" />
                    @error('buku_judul')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_penulis_id" class="form-label">Penulis Buku *</label>
                    <select name="buku_penulis_id" id="buku_penulis_id" class="form-control">
                        <option selected value="">
                            -Pilih Penulis Buku-
                        </option>
                        @foreach ($data_fk['penulis'] as $data)
                            <option value={{ $data->penulis_id }}>
                                {{ $data->penulis_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('buku_penulis_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_penerbit_id" class="form-label">Penerbit Buku *</label>
                    <select name="buku_penerbit_id" id="buku_penerbit_id" class="form-control">
                        <option selected value="">
                            -Pilih Penerbit Buku-
                        </option>
                        @foreach ($data_fk['penerbit'] as $data)
                            <option value={{ $data->penerbit_id }}>
                                {{ $data->penerbit_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('buku_penerbit_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_thnterbit" class="form-label">Tahun Terbit *</label>
                    <input type="text" name="buku_thnterbit" id="buku_thnterbit" class="form-control"
                        placeholder="Masukkan tahun terbit" />
                    @error('buku_thnterbit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_kategori_id" class="form-label">Kategori Buku *</label>
                    <select name="buku_kategori_id" id="buku_kategori_id" class="form-control">
                        <option selected value="">
                            -Pilih Kategori Buku-
                        </option>
                        @foreach ($data_fk['kategori'] as $data)
                            <option value={{ $data->kategori_id }}>
                                {{ $data->kategori_nama }}
                            </option>
                        @endforeach

                    </select>
                    @error('buku_kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_rak_id" class="form-label">Rak Buku *</label>
                    <select name="buku_rak_id" id="buku_rak_id" class="form-control">
                        <option selected value="">
                            -Pilih Rak Buku-
                        </option>
                        @foreach ($data_fk['rak'] as $data)
                            <option value={{ $data->rak_id }}>
                                {{ $data->rak_nama }} ({{ $data->rak_lokasi }})
                            </option>
                        @endforeach
                    </select>
                    @error('buku_rak_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_isbn" class="form-label">Nomor ISBN *</label>
                    <input type="text" name="buku_isbn" id="buku_isbn" class="form-control"
                        placeholder="Masukkan nomor ISBN" />
                    @error('buku_isbn')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_gambar" class="form-label">Gambar Buku</label>
                    <input type="file" name="buku_gambar" id="buku_gambar" class="form-control" />
                    @error('buku_gambar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
        <form action="{{ route('action.buku.update', ['id' => $editID]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row gap-3">
                <div class="col-12 col-md-4 form-group">
                    <label class="form-label">ID Buku </label>
                    <input type="text" class="form-control" value="{{ $editID }}" disabled />
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_judul" class="form-label">Judul Buku *</label>
                    <input type="text" name="buku_judul" id="buku_judul" class="form-control"
                        placeholder="Masukkan judul buku" value="{{ $data_buku[0]['buku_judul'] }}" />
                    @error('buku_judul')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_penulis_id" class="form-label">Penulis Buku *</label>
                    <select name="buku_penulis_id" id="buku_penulis_id" class="form-control">
                        <option value="">
                            -Pilih Penulis Buku-
                        </option>

                        @foreach ($data_fk['penulis'] as $data)
                            <option value="{{ $data->penulis_id }}"
                                {{ $data->penulis_nama == $data_buku[0]['buku_penulis'] ? 'selected' : '' }}>
                                {{ $data->penulis_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('buku_penulis_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_penerbit_id" class="form-label">Penerbit Buku *</label>
                    <select name="buku_penerbit_id" id="buku_penerbit_id" class="form-control">
                        <option value="">
                            -Pilih Penerbit Buku-
                        </option>
                        @foreach ($data_fk['penerbit'] as $data)
                            <option value="{{ $data->penerbit_id }}"
                                {{ $data->penerbit_nama == $data_buku[0]['buku_penerbit'] ? 'selected' : '' }}>
                                {{ $data->penerbit_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('buku_penerbit_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_thnterbit" class="form-label">Tahun Terbit *</label>
                    <input type="text" name="buku_thnterbit" id="buku_thnterbit" class="form-control"
                        placeholder="Masukkan tahun terbit" value="{{ $data_buku[0]['buku_thnterbit'] }}" />
                    @error('buku_thnterbit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_kategori_id" class="form-label">Kategori Buku *</label>
                    <select name="buku_kategori_id" id="buku_kategori_id" class="form-control">
                        <option value="">
                            -Pilih Kategori Buku-
                        </option>
                        @foreach ($data_fk['kategori'] as $data)
                            <option value="{{ $data->kategori_id }}"
                                {{ $data->kategori_nama == $data_buku[0]['buku_kategori'] ? 'selected' : '' }}>
                                {{ $data->kategori_nama }}
                            </option>
                        @endforeach

                    </select>
                    @error('buku_kategori_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_rak_id" class="form-label">Rak Buku *</label>
                    <select name="buku_rak_id" id="buku_rak_id" class="form-control">
                        <option value="">
                            -Pilih Rak Buku-
                        </option>
                        @foreach ($data_fk['rak'] as $data)
                            <option value="{{ $data->rak_id }}"
                                {{ $data->rak_lokasi == $data_buku[0]['buku_rak'] ? 'selected' : '' }}>
                                {{ $data->rak_nama }} ({{ $data->rak_lokasi }})
                            </option>
                        @endforeach
                    </select>
                    @error('buku_rak_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 col-md-4 form-group">
                    <label for="buku_isbn" class="form-label">Nomor ISBN *</label>
                    <input type="text" name="buku_isbn" id="buku_isbn" class="form-control"
                        placeholder="Masukkan nomor ISBN" value="{{ $data_buku[0]['buku_isbn'] }}" />
                    @error('buku_isbn')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>










                <div class="col-12 col-md-4 form-group">
                    <label for="buku_gambar" class="form-label">Gambar Buku</label>
                    <input type="file" name="buku_gambar" id="buku_gambar" class="form-control" />
                    @error('buku_gambar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
@elseif($action == 'siswa')
    @section('content_subtitle', 'Halaman peminjaman buku')
    <div class="row row-cols-6">
        <a href="/buku" class="btn btn-outline-dark mx-2 my-2 col ">
            Semua
        </a>
        @foreach ($data_kategori as $kategori)
            <a href="/buku/{{ $kategori['kategori_id'] }}" class="btn btn-outline-dark mx-2 my-2 col ">
                {{ $kategori['kategori_nama'] }}
            </a>
        @endforeach

        {{-- <button type="button" class="btn btn-outline-dark mx-auto">
            Komik
        </button>

        <button type="button" class="btn btn-outline-dark mx-auto">
            Anak-anak
        </button>

        <button type="button" class="btn btn-outline-dark mx-auto">
            Petunjuk manual
        </button> --}}
    </div>
    <div class="row gap-4 mt-4 mb-5">
        @foreach ($data_buku as $buku)
            <div class="card col-12 col-md-4 col-lg-3">
                <div class="card-body">
                    <img src="{{ asset('storage/buku_pictures/' . basename($buku['buku_urlgambar'])) }}"
                        alt="Bulan" class="book-img" />
                    <hr />
                    <p class="text-center fw-bolder fs-4 my-0">
                        {{ $buku['buku_judul'] }}
                    </p>
                    <p class="text-center mb-3">
                        Ditulis oleh {{ $buku['buku_penulis'] }}
                    </p>
                    <p class="text-center mb-3">
                        {{ $buku['buku_kategori'] }}
                    </p>
                    <button type="button" class="btn btn-primary d-block mx-auto w-50" data-bs-toggle="modal"
                        data-bs-target="#confirmModal{{ $buku['buku_id'] }}">
                        Detail
                    </button>

                    <div class="modal fade" id="confirmModal{{ $buku['buku_id'] }}" tabindex="-1"
                        aria-labelledby="confirmModal{{ $buku['buku_id'] }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="confirmModal{{ $buku['buku_id'] }}Label">
                                        Peminjaman Buku</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <span>Detail Buku:</span>
                                        <ul class="mt-2">
                                            <li>Judul: {{ $buku['buku_judul'] }}</li>
                                            <li>Kategori: {{ $buku['buku_kategori'] }}</li>
                                            <li>Penulis: {{ $buku['buku_penulis'] }}</li>
                                            <li>Penerbit: {{ $buku['buku_penerbit'] }}</li>
                                            <li>Lokasi Rak: {{ $buku['buku_rak'] }}</li>
                                            <li>Serial ISBN: {{ $buku['buku_isbn'] }}</li>
                                        </ul>
                                    </div>
                                    <div class="mt-3">
                                        <span>Keterlambat mengumpulkan buku kemungkinan akan dikenakan denda. Apakah
                                            anda ingin meminjam buku ini?</span>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <a href="/buku/pinjam/{{ $buku['buku_id'] }}" class="btn btn-primary"
                                        type="button">Pinjam</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- <div class="card col-12 col-md-4 col-lg-3">
            <div class="card-body">
                <img src="./img/book.png" alt="Bulan" class="book-img" />
                <hr />
                <p class="text-center fw-bolder fs-4 my-0">
                    Bulan
                </p>
                <p class="text-center mb-3">
                    Ditulis oleh Tere Liye
                </p>
                <button class="btn btn-primary d-block mx-auto" type="submit">
                    Pinjam
                </button>
            </div>
        </div> --}}
        {{-- <div class="card col-12 col-md-4 col-lg-3">
            <div class="card-body">
                <img src="./img/book.png" alt="Bulan" class="book-img" />
                <hr />
                <p class="text-center fw-bolder fs-4 my-0">
                    Bulan
                </p>
                <p class="text-center mb-3">
                    Ditulis oleh Tere Liye
                </p>
                <button class="btn btn-primary d-block mx-auto" type="submit">
                    Pinjam
                </button>
            </div>
        </div> --}}
    </div>
@endif
@endsection
