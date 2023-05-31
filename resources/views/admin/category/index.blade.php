<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    <div>

        @if(count($categories) > 0 ):
        @foreach($categories as $category):
        <div>
            <span>Nome : {{$category->name}}</span>
        </div>

        <div>
            <span>Descrição : {{$category->description}}</span>
        </div>

        @endfor
        @else 
        <div>Nenhuma categoria encontrada</div>

    </div>
</body>
</html>