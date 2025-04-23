<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>laravel App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth/style.css') }}">
</head>
<body> 
    {{ $slot }}
</body>
<script src="{{ asset('assets/js/auth/script.js') }}"></script>
</html>