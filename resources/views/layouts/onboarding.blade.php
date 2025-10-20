<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PDMP Outdoor')</title>
    <link rel="stylesheet" href="{{ asset('css/onboarding.css') }}">
</head>
<body>
    <div class="onboarding-wrapper">
        @yield('content')
    </div>
    <script src="{{ asset('js/onboarding.js') }}"></script>
</body>
</html>
