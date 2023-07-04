<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conta Pessoal</title>
    @include('layouts.bootstrap')
</head>
<body>
    <div class="container">

        @if (session('message'))
            <div class="alert alert-dark" role="alert">
                {{session('message')}}
            </div>
        @endif

        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                <h1>
                {{$user->name}}
                </h1>
                <h6>
                    {{$user->email}}
                </h6>
                <h6>
                    Você tem R$ 
                    @if($user->cash == 0)
                        0
                    @else
                        {{$user->cash}}
                    @endif
                </h6>
            </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/home">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/user/account/pay">Comprar Saldo</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/user/history">Histórico de Partidas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/user/logout">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </div>
</body>
</html>