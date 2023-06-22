<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/user/login" method="post">
        @csrf
        <input type="text" name="name" id="name">
        <label for="name">Nome</label>
        <input type="text" name="password" id="password">
        <label for="password">Senha</label>
        <input type="submit" value="Logar!">
    </form>
</body>
</html>