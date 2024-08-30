@extends('template.layout')

@section('title', 'Dashboard - ' . ($level == 'admin' ? 'Admin' : '') . ' Perpustakaan')

@section('content_title', 'Penerbit')

@section('main')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
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
                            <th scope="col">Alamat Penerbit</th>
                            <th scope="col">No Telp Penerbit</th>
                            <th scope="col">Email Penerbit</th>
                            <th>
                                <div class="px-2">Aksi</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_penerbit as $index => $penerbit)
                            <tr>
                                <td scope="row">{{ $index + 1 }}</td>
                                <td>{{ $penerbit['penerbit_id'] }}</td>
                                <td>{{ $penerbit['penerbit_nama'] }}</td>
                                <td>{{ $penerbit['penerbit_alamat'] }}</td>
                                <td>{{ $penerbit['penerbit_notelp'] }}</td>
                                <td>{{ $penerbit['penerbit_email'] }}</td>
                                <td style="text-align: center">
                                    <a class="px-2" href="edit?id={{ $penerbit['penerbit_id'] }}">Edit</a>
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
                                                    Apakah anda yakin ingin menghapus penerbit buku
                                                    {{ $penerbit['penerbit_nama'] }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <a href="delete?id={{ $penerbit['penerbit_id'] }}"
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
            <a href="create" class="btn btn-primary my-3">Tambah Penerbit</a>
        </div>
    @elseif($action == 'create')
    @section('content_subtitle', 'Form tambah penerbit')
    <div class="mb-5">
        <form action="{{ route('action.penerbit.create') }}" method="POST">
            @csrf
            <div>
                <label for="penerbit_nama" class="form-label">
                    Nama Penerbit *
                </label>
                <input type="text" class="form-control" id="penerbit_nama" name="penerbit_nama" required />
                @error('penerbit_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penerbit_alamat" class="form-label">
                    Alamat Penerbit *
                </label>
                <input type="text" class="form-control" id="penerbit_alamat" name="penerbit_alamat" required />
                @error('penerbit_alamat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penerbit_notelp" class="form-label">
                    Nomor Telepon Penerbit *
                </label>
                <input type="text" class="form-control" id="penerbit_notelp" name="penerbit_notelp" required />
                @error('penerbit_notelp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penerbit_email" class="form-label">
                    Email Penerbit *
                </label>
                <input type="email" class="form-control" id="penerbit_email" name="penerbit_email" required />
                @error('penerbit_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambah Penerbit" class="btn btn-primary" />
            </div>
        </form>
    </div>
@elseif($action == 'edit')
    @section('content_subtitle', 'Form edit penerbit')
    <div class="mb-5">
        <form action="{{ route('action.penerbit.update', ['id' => $editID]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label class="form-label">
                    ID *
                </label>
                <input type="text" class="form-control" disabled value="{{ $editID }}" />
                @error('penerbit_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penerbit_nama" class="form-label">
                    Nama Penerbit *
                </label>
                <input type="text" class="form-control" id="penerbit_nama" name="penerbit_nama" required
                    value="{{ $data_penerbit->penerbit_nama }}" />
                @error('penerbit_nama')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penerbit_alamat" class="form-label">
                    Alamat Penerbit *
                </label>
                <input type="text" class="form-control" id="penerbit_alamat" name="penerbit_alamat" required
                    value="{{ $data_penerbit->penerbit_alamat }}" />
                @error('penerbit_alamat')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penerbit_notelp" class="form-label">
                    Nomor Telepon Penerbit *
                </label>
                <input type="text" class="form-control" id="penerbit_notelp" name="penerbit_notelp" required
                    value="{{ $data_penerbit->penerbit_notelp }}" />
                @error('penerbit_notelp')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <label for="penerbit_email" class="form-label">
                    Email Penerbit *
                </label>
                <input type="email" class="form-control" id="penerbit_email" name="penerbit_email" required
                    value="{{ $data_penerbit->penerbit_email }}" />
                @error('penerbit_email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mt-4">
                <input type="submit" value="Tambah Penerbit" class="btn btn-primary" />
            </div>
        </form>
    </div>
@endif
@endsection
