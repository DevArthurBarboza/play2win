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
    <div>
        <div class="container">

            
            <a href="/user/account/index">Voltar</a>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Jogo</th>
                    <th scope="col">Data</th>
                    <th scope="col">Alteração de Saldo</th>
                    <th scope="col">Novo Saldo</th>
                  </tr>
                </thead>
                <tbody> 
            
            @forelse ($history as $match)
                    
                @php 
                for($i = 0; $i < count($games);$i++){
                    if($games[$i]->id == $i && $i == $match->game_id){
                        if($match->won == 1){
                            $class = "success";
                        }else{
                            $class = "danger";
                        }
                    }
                }
                    
                @endphp
            
                  <tr>
                    <td>
                        {{$games[$match->game_id]->name}}
                    </td>
                    <td>
                        {{$match->created_at}}
                    </td>
                    <td class="table-{{$class}}" >
                        R${{$match->bet_amount}}
                    </td>
                    <td>R${{$match->new_cash}}</td>
                  </tr>
                         
            
            @empty
            
            <div>
                Histórico Vazio
            </div>
            </tbody>
            </table>   
            @endforelse
        </div>
    </div>
</div>
</body>
</html>