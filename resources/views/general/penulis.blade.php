@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Penulis')

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                            <th scope="col">Tempat Lahir Penulis</th>
                            <th scope="col">Tanggal Lahir Penulis</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_penulis as $index => $penulis)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $penulis['penulis_id'] }}</td>
                                <td>{{ $penulis['penulis_nama'] }}</td>
                                <td>{{ $penulis['penulis_tmptlahir'] }}</td>
                                <td>{{ $penulis['penulis_tgllahir'] }}</td>
                                <td style="text-align: center">
                                    <a class="px-2" href="edit?id={{ $penulis['penulis_id'] }}">Edit</a>
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
                                                    Apakah anda yakin ingin menghapus penulis buku
                                                    {{ $penulis['penulis_nama'] }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <a href="delete?id={{ $penulis['penulis_id'] }}"
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
            <a href="create" class="btn btn-primary my-3">Tambah Penulis</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah penulis')
    <div class="mb-5">
        <form action="{{ route('action.penulis.create') }}" method="POST">
            @csrf
            <div>
                <label for="penulis_nama" class="form-label">
                    Nama Penulis *
                </label>
                <input type="text" class="form-control" id="penulis_nama" name="penulis_nama" required />
                @error('penulis_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="mt-4">
                <label for="penulis_tgllahir" class="form-label">
                    Tanggal Lahir *
                </label>
                <input type="date" class="form-control" id="penulis_tgllahir" name="penulis_tgllahir" />
                @error('penulis_tgllahir')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penulis_tmptlahir" class="form-label">
                    Tempat Lahir *
                </label>
                <input type="text" class="form-control" id="penulis_tmptlahir" name="penulis_tmptlahir" />
                @error('penulis_tmptlahir')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambah Penulis" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif($action == 'edit')
    @section('content_subtitle', 'Form edit penulis')
    <div class="mb-5">
        <form action="{{ route('action.penulis.update', ['id' => $editID]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">
                    ID Penulis
                </label>
                <input type="text" class="form-control" value="{{ $editID }}" disabled />

            </div>
            <div class="mt-4">
                <label for="penulis_nama" class="form-label">
                    Nama Penulis *
                </label>
                <input type="text" class="form-control" id="penulis_nama" name="penulis_nama" required
                    value="{{ $data_penulis->penulis_nama }}" />
                @error('penulis_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="mt-4">
                <label for="penulis_tgllahir" class="form-label">
                    Tanggal Lahir *
                </label>
                <input type="date" class="form-control" id="penulis_tgllahir" name="penulis_tgllahir" required
                    value="{{ $data_penulis->penulis_tgllahir }}" />
                @error('penulis_tgllahir')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penulis_tmptlahir" class="form-label">
                    Tempat Lahir *
                </label>
                <input type="text" class="form-control" id="penulis_tmptlahir" name="penulis_tmptlahir" required
                    value="{{ $data_penulis->penulis_tmptlahir }}" />
                @error('penulis_tmptlahir')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambah Penulis" class="btn btn-primary" />
            </div>
        </form>
    </div>
@endif
@endsection
