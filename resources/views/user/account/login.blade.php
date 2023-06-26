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
    <div class="container" style="display: flex;justify-content:space-around;margin-top:200px">

    <form action="/user/login" method="post">
        @csrf

        <div class="card-body">
            <h5 class="card-title">Usuário</h5>
            <div style="margin: 20px 0px;">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name">
            </div>
            <div style="margin-bottom: 20px">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="submit" value="Logar!">
            </div>
          </div>
        </div>
        
    </form>
    </div>
</body>
</html>