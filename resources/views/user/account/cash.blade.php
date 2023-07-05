<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('layouts.bootstrap')
</head>
<body>
    <div class="container">

        <form action="/user/account/pay" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        Você tem <em>R$ {{$user->cash}}</em>
                    </div>
                    <div class="card-text">
                        <div>
                            <input type="number" step="0.01" min="1" name="cash">
                            <button>Comprar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>