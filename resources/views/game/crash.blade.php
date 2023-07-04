<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$game->name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <script>
        const Crash = {

            usuarioAcertou : false,
            novoSaldo : 0,

            validar : function (value){
                if(value == undefined) value = document.getElementById('aposta').value
                let saldo = document.getElementById('saldo').textContent;
                if (parseFloat(value) > parseFloat(saldo)){
                    document.getElementById('confirm').disabled = true
                    return false;
                }
                document.getElementById('confirm').disabled = false
                return true
            },

            play :function(){
                if(this.validar()){
                    let multiplier = document.getElementById('multiplier').value
                    let resultado = (Math.random() * {{$game->multiplier}}).toFixed(2)
                    let saldo = document.getElementById('saldo').textContent
                    let aposta = document.getElementById('aposta').value
                    this.novoSaldo = saldo
                    
                    document.getElementById('tela-jogo').innerText= resultado + "x"

                    if(parseFloat(resultado) >= parseFloat(multiplier)){
                        
                        this.novoSaldo = parseFloat(this.novoSaldo) + parseFloat(aposta) * parseFloat(multiplier)
                        this.usuarioAcertou = true
                        
                        document.getElementById('resultado-container').setAttribute('style',"display:block")
                        let resultado = document.getElementById('resultado')
                        resultado.setAttribute('style',"display:block")
                        resultado.innerHTML = "<p>Você Ganhou !</p><p>Novo Saldo: R$" + this.novoSaldo + "</p>"


                    }else{
                        this.novoSaldo -= aposta
                        this.usuarioAcertou = false

                        document.getElementById('resultado-container').setAttribute('style',"display:block")
                        let resultado = document.getElementById('resultado')
                        resultado.setAttribute('style',"display:block")
                        resultado.innerHTML = "<p>Você Perdeu !</p><p>Novo Saldo: R$" + this.novoSaldo + "</p>"
                    }

                    document.getElementById('aposta').style.backgroundColor = 'none'
                    this.atualizarSaldo()
                    return
                }
                document.getElementById('aposta').style.backgroundColor = 'red'
            },

            atualizarSaldo : function(){
                let saldo = this.novoSaldo
                let aposta = document.getElementById('aposta').value;
                let user_id = document.getElementById('user_id').value
                let multiplier = document.getElementById('multiplier').value
                let url = "https://play2win.lndo.site/user/account/updatecash"
                let game_id = document.getElementById('game_id').value
                if(this.usuarioAcertou){
                    aposta = parseFloat(aposta) * parseFloat(multiplier)
                }
                let dados = {'novoSaldo' : saldo, 'user_id' : user_id, 'won' : this.usuarioAcertou, 'game_id' : game_id, 'alteracao_saldo' : aposta}
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(url, {
                    method: 'POST', 
                    credentials: "same-origin",
                    headers: {
                        'Content-Type': 'application/json', 
                       
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify(dados), 
                })
                .then(data => {
                    teste = saldo
                    document.getElementById('saldo').textContent = saldo
                })
                .catch(error => {
                    throw new Error(error.toString())
                });

            },

            calcularNovoSaldo : function(){
                let saldo = document.getElementById('saldo').textContent;
                let aposta = document.getElementById('aposta').value;
                let multiplicador = document.getElementById('multiplicador').value
                if(this.usuarioAcertou){
                    return parseFloat(saldo) + (parseFloat(aposta) * parseFloat(multiplicador))

                }
                return parseFloat(saldo) - (parseFloat(aposta) * parseFloat(multiplicador))
            },

            close : function(){
                document.getElementById('resultado-container').setAttribute('style','display:none');
                document.getElementById('resultado').innerHTML="";
                document.getElementById('tela-jogo').innerHTML="";
            }
        }
        
    </script>

    <a href="/user/account/index"> Voltar</a>
    <div>
        <span>Seu Saldo: R$</span>
        <span id="saldo">{{$user->cash}}</span>
    </div>
    <label for="aposta">Valor à apostar</label>
    <input onchange="Crash.validar(this.value)" type="number" name="aposta" id="aposta">

    <label for="cor">Informe o multiplicador</label>
    <input type="number" name="multiplier" id="multiplier">

    <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
    <input type="hidden" id="game_id" name="game_id" value="{{$game->id}}">

    <button id="confirm" onclick="Crash.play()">Confirmar!</button>

    <div id="tela-jogo">

    </div>
    <div style="display: none;width:200px; position:fixed;" id="resultado-container">
        <button style="color:white;border:1px solid red;background-color:red;" onclick="Crash.close()">X</button>
        <div id="resultado" style="display: none;width:200px;">

        </div>
    </div>

</body>
</html>