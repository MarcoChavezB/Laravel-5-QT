<!-- resources/views/principal/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    @vite('resources/css/app.css')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación</title>
</head>
<body class="bg-gray-100">
    <div class="w-full grid h-full">
        <x-navbar />

        <div class="w-full  flex justify-center items-center" style="height: 80vh;">
            @yield('content')
        </div>
    </div>
</body>
</html>
