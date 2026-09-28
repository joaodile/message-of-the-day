<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $pageTitle }}</title>

        @fonts
        @vite(['resources/css/app.css'])
    </head>
    <body class="bg-zinc-100">
        {{ $slot }}
    </body>
</html>
