<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$game->name}}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://pixijs.download/release/pixi.js"></script>
</head>
<body>
    <script>
        const Crash = {

            usuarioAcertou : false,
            novoSaldo : 0,
            saldoValido : false,
            multiplicadorValido : false,

            validarCampo : function(campo){
                if(campo.value < 0){
                    document.getElementById('confirm').disabled = true
                    this.multiplicadorValido = false
                    return false;
                }
                this.multiplicadorValido = true
                if(this.multiplicadorValido && this.saldoValido){
                    document.getElementById('confirm').disabled = false
                }
            },

            validar : function (value){
                if(value == undefined) value = document.getElementById('aposta').value
                let saldo = document.getElementById('saldo').textContent;
                if (parseFloat(value) > parseFloat(saldo) || parseFloat(value) <= 0 ){
                    this.saldoValido = false
                    document.getElementById('confirm').disabled = true
                    return false;
                }
                this.saldoValido = true
                if(this.multiplicadorValido && this.saldoValido){
                    document.getElementById('confirm').disabled = false
                }
                return true
            },

            gerarGrafico : function(valor){                
                document.getElementById('grafico').innerHTML = '';
                const app = new PIXI.Application({ width: 300, height: {{$game->multiplier}} + 5});
                            
                    const graphics = new PIXI.Graphics();
                    graphics.beginFill(0xFF0000);
                    graphics.drawRect(50, 250, 200, 0); // Altura inicial definida como 0
                    graphics.endFill();

                    app.stage.addChild(graphics);

                    const targetHeight = valor; // Altura final do retângulo
                    const animationDuration = 2000;
                    const startHeight = graphics.height; // Altura inicial do retângulo
                    let startTime = null;

                    const text = new PIXI.Text('', { fontFamily: 'Arial', fontSize: 24, fill: 'white' });
                    text.position.set(100, 250 - targetHeight); // Posição do texto ajustada
                    app.stage.addChild(text);

                    function animate(timestamp) {
                        if (!startTime) {
                            startTime = timestamp;
                        }
                        const elapsed = timestamp - startTime;
                        const progress = Math.min(elapsed / animationDuration, 1);
                        const newHeight = startHeight + (targetHeight - startHeight) * progress;
                  
                        graphics.clear();
                        graphics.beginFill(0xFF0000);
                        graphics.drawRect(50, 250 - newHeight, 200, newHeight); // Desenho do retângulo ajustado
                        graphics.endFill();
                  
                        text.position.y = 250 - newHeight; // Posição do texto ajustada
                        text.text = Math.round(newHeight).toString();
                  
                        if (progress < 1) {
                            requestAnimationFrame(animate);
                        }
                    }
                document.getElementById('grafico').appendChild(app.view);
                requestAnimationFrame(animate);
            },

            play :function(){
                if(this.validar()){
                    let multiplier = document.getElementById('multiplier').value
                    let resultado = (Math.random() * {{$game->multiplier}}).toFixed(2)
                    this.gerarGrafico(resultado)
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
                document.getElementById('grafico').innerHTML="";
            }
        }
        
    </script>

    <a href="/home"> Voltar</a>
    <div>
        <h3>Seu Saldo: R$<span id="saldo">{{$user->cash}}</span></h3>
    </div>
    <h3>Multiplicador : {{$game->multiplier}}x</h3>
    <label for="aposta">Valor à apostar</label>
    <input onchange="Crash.validar(this.value)" type="number" name="aposta" id="aposta">

    <label for="cor">Informe o multiplicador</label>
    <input type="number" name="multiplier" onchange="Crash.validarCampo(this)" id="multiplier">

    <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
    <input type="hidden" id="game_id" name="game_id" value="{{$game->id}}">

    <button id="confirm" onclick="Crash.play()">Confirmar!</button>

    <div id="grafico">

    </div>
    <div id="tela-jogo">

    </div>
    <div style="display: none;width:200px; position:fixed;" id="resultado-container">
        <button style="color:white;border:1px solid red;background-color:red;" onclick="Crash.close()">X</button>
        <div id="resultado" style="display: none;width:200px;">

        </div>
    </div>

</body>
</html>