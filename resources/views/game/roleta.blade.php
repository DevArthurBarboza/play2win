<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roleta</title>
</head>
<body>

    <script>
        
        function validar(value){
            let saldo = document.getElementById('saldo').textContent;
            if (value > saldo){
                document.getElementById('aposta').value = saldo
                document.getElementById('confirm').disabled = true
                return;
            }
            document.getElementById('confirm').disabled = false
        }


        function play(){
            let saldo = document.getElementById('saldo').textContent;
            let aposta = document.getElementById('aposta').textContent;
        }

    </script>

    <div>
        <span>Seu Saldo: R$</span>
        <span id="saldo">{{$user->cash}}</span>
    </div>
    <label for="aposta">Valor à apostar</label>
    <input onchange="validar(this.value)" type="number" name="aposta" id="aposta">

    <button id="confirm" onclick="play">Confirmar!</button>

</body>
</html>