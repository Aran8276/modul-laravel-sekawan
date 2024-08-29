<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-styles.css') }}">
</head>

<body>
    <section class="login-container">
        <div class="card shadow-lg">
            <div class="card-header p-4">
                <h2>Buat Buku</h2>
            </div>
            <div class="card-body">
                <form method="POST">
                    @csrf
                    <input name="bookcode" class="form-control" placeholder="Kode Buku"></br>
                    @error('bookcode')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="bookname" class="form-control" placeholder="Nama Buku"></br>
                    @error('bookname')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="publisher" class="form-control" placeholder="Penerbit Buku"></br>
                    @error('publisher')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="writer" class="form-control" placeholder="Penulis Buku"></br>
                    @error('writer')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input name="year" class="form-control" placeholder="Tahun Terbit"></br>
                    @error('year')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-primary btn" type="submit">Kirim</button>
                </form>
            </div>
        </div>
    </section>
</body>

<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</html>


<!--
Inputan
kode buku
nama buku,
penulis buku
penerbit buku
tahun terbit

maksimal berisi 4 huruf, dan inputan ini wajib diisi.
Inputan
, dan

minimal berisi 10 huruf, maksimal berisi 40 huruf dan wajib diisi.
Inputan  maksimal berisi 4 angka dan inputan ini boleh dikosongkan nilainya.
Error Validasi yang telah dibuat harus ditampilkan di bawah tiap-tiap inputan yang sesuai.
-->
