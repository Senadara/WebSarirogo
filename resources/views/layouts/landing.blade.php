<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Desa Sarirogo' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-900">

    <header class="flex justify-center mt-8">
        @include('components.layouts.navbar')
    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>
