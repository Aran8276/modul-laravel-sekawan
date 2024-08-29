<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bootstrap View</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Untuk pengunaan directive 'asset' akan mengakses yang ada di folder `/public` --->
</head>

<body>
    <main>
        <div class="container my-5">
            <div class="card">
                <h3>Halo, ini Bootstrap yang sudah terhubung dengan Laravel</h3>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Untuk pengunaan directive 'asset' akan mengakses yang ada di folder `/public` --->
</body>

</html>
