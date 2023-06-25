<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conta Pessoal</title>
</head>
<body>
    <a href="/home">Ir pra Home</a>
    @if (session('message'))
        {{session('message')}}
    @endif
    <div>Olá {{$user->name}} ! </div>
    <div>{{$user->email}}</div>
    <div>
        Você tem R$ {{$user->cash}} 
        <div>
            <a href="/user/account/pay">Quero Mais!</a>
        </div>
    </div>
    <div>
        <a href="/user/logout">Logout</a>
    </div>
</body>
</html>