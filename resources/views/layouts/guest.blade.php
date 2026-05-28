<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIKAT</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    {{-- TRIK JITU: Definisikan variabel CSS di sini agar VS Code tidak bingung --}}
    <style>
        :root {
            --login-bg: url("{{ asset('images/bg.png') }}");
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-cover bg-center bg-no-repeat"
      style="background-image: var(--login-bg);">

    <div class="w-full max-w-xl">
        {{ $slot }}
    </div>

</body>
</html>