<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Document</title>
</head>
<body>
    <div name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}

            <a href="/dashboard/category/create">| Criar Categoria |</a>
            <a href="/dashboard/category/index">Mostrar Categorias</a>
        </h2>
    </div>

    <div>

        @if(count($categories) > 0 ):
        @foreach($categories as $category):
        <div>
            <span>Nome : {{$category->name}}</span>
        </div>

        <div>
            <span>Descrição : {{$category->description}}</span>
        </div>

        @endforeach
        @else
        <div>Nenhuma categoria encontrada</div>
        @endif
    </div>
</body>
</html>
