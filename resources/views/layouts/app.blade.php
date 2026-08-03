<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Surprise — Kado Digital & Halaman Romantis Spesial' }}</title>
    <meta name="description" content="Buat halaman surprise romantis untuk pasanganmu dengan foto, musik, cerita dan hitung mundur. Dapatkan link custom & QR code instan.">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen font-body antialiased selection:bg-romantic-deep selection:text-romantic-base">
    {{ $slot }}

    @livewireScripts
</body>
</html>
