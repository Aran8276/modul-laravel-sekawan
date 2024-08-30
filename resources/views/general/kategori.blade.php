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
                        @foreach ($data_kategori as $index => $kategori)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $kategori['kategori_id'] }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-dark mx-auto">
                                        {{ $kategori['kategori_nama'] }}
                                    </button>
                                </td>
                                <td style="text-align: center">
                                    <a class="px-2" href="edit?id={{ $kategori['kategori_id'] }}">Edit</a>
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
                                                    <!-- Table Action Href Array Content -->
                                                    Apakah anda yakin ingin menghapus kategori buku
                                                    {{ $kategori['kategori_nama'] }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <a href="delete?id={{ $kategori['kategori_id'] }}"
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
            <a href="create" class="btn btn-primary my-3">Buat Kategori</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah kategori')
    <div class="mb-5">
        <form action="{{ route('action.kategori.create') }}" method="POST">
            @csrf
            <div>
                <label for="kategori_nama" class="form-label">
                    Nama Kategori *
                </label>
                <input type="text" class="form-control" id="kategori_nama" name="kategori_nama" required />
                @error('kategori_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Buat Kategori" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif($action == 'edit')
    @section('content_subtitle', 'Form edit kategori')
    <div class="mb-5">
        <form action="{{ route('action.kategori.update', ['id' => $editID]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label"> ID Kategori </label>
                <input type="text" value="{{ $editID }}" class="form-control" disabled />
            </div>
            <div class="mt-4">
                <label for="kategori_nama" class="form-label">
                    Nama Kategori *
                </label>
                <input type="text" class="form-control" id="kategori_nama" name="kategori_nama"
                    value="{{ $data_kategori->kategori_nama }}" required />
                @error('kategori_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Edit Kategori" class="btn btn-primary" />
            </div>
        </form>
    </div>
@endif
@endsection
