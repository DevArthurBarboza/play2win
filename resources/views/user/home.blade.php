<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.bootstrap')
    <title>HOME</title>
</head>
<body>

    <div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 collapse navbar-collapse">
            <li class="nav-item">
                <h1 class="navbar-brand">
                    HOME
                </h1>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="/user/account/index">Meu Perfil</a>
            </li>
        </ul>
    </nav>

    <div class="container">
        <div id="categories-container" style="border:5px solid black; margin:0 0 100px 0;padding:15px">
            <h1>Categorias</h1>
            @forelse ($categories as $category)
            <div class="category-container" style="border:2px solid black; margin:0 0 20px 0;padding:15px">
                <div><h2>{{$category->name}}</h2></div>
                <div>{{$category->description}}</div>
                <a href="/user/category/game/{{$category->id}}">Acessar Categoria</a>
            </div>
            @empty
            <div>
                Nenhuma Categoria Encontrada
            </div>
            @endforelse
        </div>
    </div>

    <div class="container">
        <div id="games-container" style="border:5px solid black;padding:15px">
            <h1>Jogos</h1>
            @forelse ($games as $game)
            <div class="game-container"  style="border:2px solid black; margin:0 0 20px 0;padding:15px">
            <div><h2>{{$game->name}}</h2></div>
            @php 
                
            @endphp
            <a href="/game/{{$game->id}}">Jogar!</a>
        </div>
        @empty
        <div>
            Nenhum Jogo Encontrada
        </div>
        @endforelse
    </div>
</div>
</div>
    
</body>
</html>