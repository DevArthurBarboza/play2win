<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @include('layouts.bootstrap')

    </head>
    <body class="antialiased">
        <div class="container" style="display: flex;justify-content:space-around;margin-top:200px">

          
        <div class="card" style="width: 18rem;display:inline-block">
            <div class="card-body">
              <h5 class="card-title">Usuário</h5>
              <div>
                  <a href="/user/login">Logar</a>
              </div>
              <div>
                  <a href="/user/register">Registrar Usuário</a>
              </div>
            </div>
          </div>


          <div class="card" style="width: 18rem;display:inline-block">
            <div class="card-body">   
            <h5 class="card-title">Painel Admin</h5>           
            <div>
                <a href="/dashboard">Logar</a>
            </div>
            <div>
                <a href="/register">Registrar Usuário</a>
            </div>
            </div>
          </div>

          <div class="card" style="width: 18rem;display:inline-block">
            <div class="card-body">   
                <h5 class="card-subtitle mb-2 text-body-secondary"><a href="/triggerSeeder">Popular Banco com Categorias e Jogos pré-definidos</a></h5>           
            </div>
          </div>
        </div>

    </body>
</html>
