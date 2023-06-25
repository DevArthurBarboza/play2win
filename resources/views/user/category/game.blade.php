<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.bootstrap')
    <title>Document</title>
</head>
<body>
    @foreach ($games as $game)
    <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h5 class="card-title">{{$game->name}}</h5>
          <h6 class="card-subtitle mb-2 text-body-secondary">{{$game->multiplier}}</h6>
          <p class="card-text">{{$game->created_at}}</p>
          <a class="card-link" href="/game/{{$game->id}}">Jogar!</a>
        </div>
      </div>
    @endforeach
</body>
</html>