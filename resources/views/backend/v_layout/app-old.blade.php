<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tokoonline</title>
</head>
<body>
    <a href="{{ route('backend.beranda') }}">Beranda</a> |
    <a href="#">User</a> |
    <a href="" onclick="event.preventDefault(); document.getElementById('keluarapp').submit();">Keluar</a>

    <p></p>

    <!-- {{-- Awal Konten --}} -->
    @yield('content')
    <!-- {{-- Akhir Konten --}} -->

    <form id="keluarapp" action="{{ route('backend.logout') }}" method="POST" class="dnone">
        @csrf
    </form>
</body>
</html>
