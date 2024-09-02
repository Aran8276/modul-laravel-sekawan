@extends('template.public-layout')

@section('title', 'Daftar - Web Perpustakaan')

@section('main')
    <div class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container mb-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <img src="{{ asset('img/book.png') }}" alt="..." class="img-logo">
                                        <h3 class="text-center font-weight-light my-4">
                                            Buat Akun - Web Perpustakaan
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('action.register') }}" method="POST">
                                            @csrf
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" type="text"
                                                            name="first_name" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">Nama depan</label>
                                                        @error('first_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text"
                                                            name="last_name" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Nama belakang</label>
                                                        @error('last_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email"
                                                    placeholder="name@example.com" />
                                                <label for="inputEmail">Email</label>
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUsername" type="text"
                                                    name="username" placeholder="viokenceng" />
                                                <label for="inputUsername">Username</label>
                                                @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputAddress" type="text" name="address"
                                                    placeholder="Jl Ikan Duyung No 11" />
                                                <label for="inputAddress">Alamat</label>
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPhone" type="number" name="phone"
                                                    placeholder="Jl Ikan Duyung No 11" />
                                                <label for="inputPhone">No telp</label>
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password"
                                                            name="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                        @error('password')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm"
                                                            name="password_confirm" type="password"
                                                            placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Konfirmasi Password</label>
                                                        @error('password_confirm')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <button class="btn btn-primary btn-block py-3" type="submit">Buat
                                                        Akun</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                            <a href="login">Sudah memiliki akun? Masuk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="js/scripts.js"></script>
    </div>
@endsection
