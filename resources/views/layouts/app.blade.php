<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Центр технического оборудования - @yield('title')</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Центр технического оборудования</a>
</header>
<div class="container mt-4">
    <div class="row">
        <div class="col-2">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Работники</li>
                <li class="list-group-item list-group-item-action">
                    <a href="{{ route('employee.index') }}">Список</a>
                </li>
                <li class="list-group-item list-group-item-action">
                    <a href="{{ route('employee.upload') }}">Загрузить</a>
                </li>
                <li class="list-group-item list-group-item-action">
                    <a target="_blank" href="/api/documentation">Swagger API</a>
                </li>
            </ul>
        </div>
        <div class="col-10">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
