<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <div>
            <em>Painel Admin</em>
            <div>
                <a href="/register">Registrar Usuário Admin</a>
            </div>
            <div>
                <a href="/dashboard">Acessar Admin</a>
            </div>
        </div>
        <div>
            <em>Usuário</em>    
            <div>
                <a href="/user/login">Logar</a>
            </div>
            <div>
                <a href="/user/register">Registrar Usuário</a>
            </div>
        </div>
    </body>
</html>
