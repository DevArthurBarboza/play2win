<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Roleta</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <script>
        const Roleta = {

            ponteiroAngulo: 0,
            destinoAngulo: 0,
            velocidadeRotacao : 0, // Velocidade de rotação inicial (será ajustada)
            aceleracao : 0.05, // Aceleração de desaceleração (ajuste conforme necessário)
            desaceleracaoLimite : 0.3, // Valor limite de desaceleração para parar o ponteiro
            animacaoRodando : false,
            ponteiroAngulo : 0,
            pointerX : 0,
            pointerY : 0,
            color : new Array('black','red','green','orange','pink','yellow'),
            numParts : 6,
            finished : false,
            usuarioAcertou : false,
            novoSaldo : 0,
            firstTry : true,
            alteracao_saldo : 0,

            

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

            validarAposta : function(){
                let numero = document.getElementById('numero');
                if(numero.value < 1 || numero.value > 6){
                    numero.value = 1
                }
            },


            girarRoleta : function () {
                return new Promise((resolve) => {
                    const angle = (2 * Math.PI) / this.numParts;
                    const randomNumber = Math.floor(Math.random() * this.numParts);
                    const destinoAngulo = randomNumber * angle;

                    // this.ponteiroAngulo = destinoAngulo;

                    this.ponteiroAngulo = 0;
                    this.desenharRoletaRecursiva(0,this.pegarValorAleatorio(20));
                    resolve();
                })
            },

            pegarValorAleatorio : function(maximo){
                let valor = Math.floor(Math.random() * maximo)
                if(valor%2 ==0){
                    return valor
                }
                return valor+1
            },

            desenharRoletaRecursiva : function(min,max){
                if(min >= max){
                    this.finished = true
                    this.finalizar()
                    document.getElementById('finished').value = true
                    return
                }
                console.log(min)

                this.ponteiroAngulo = min
                this.desenharRoleta()

                setTimeout(function(){
                    desenharRoletaRecursiva(min+1,max)
                },500)

            },


            desenharRoleta : function () {
                const canvas = document.getElementById('roletaCanvas');
                const ctx = canvas.getContext('2d');
                const centerX = canvas.width / 2;
                const centerY = canvas.height / 2;
                const radius = canvas.width / 2 - 10;

                const angle = (2 * Math.PI) / this.numParts;

                const pointerLength = 30; // Comprimento do ponteiro
                const pointerWidth = 5; // Largura do ponteiro
                const pointerColor = 'blue'; // Cor do ponteiro

                ctx.clearRect(0, 0, canvas.width, canvas.height); 


                for (let i = 0; i < this.numParts; i++) {
                    const startAngle = i * angle;
                    const endAngle = (i + 1) * angle;

                    ctx.beginPath();
                    ctx.moveTo(centerX, centerY);
                    ctx.arc(centerX, centerY, radius, startAngle, endAngle);
                    ctx.fillStyle = this.color[i];
                    ctx.fill();
                    ctx.closePath();
                }

                const pointerX = centerX + (radius - pointerLength / 2) * Math.cos(this.ponteiroAngulo);
                const pointerY = centerY + (radius - pointerLength / 2) * Math.sin(this.ponteiroAngulo);

                ctx.beginPath();
                ctx.moveTo(centerX, centerY);
                ctx.lineTo(pointerX, pointerY);
                ctx.lineWidth = pointerWidth;
                ctx.strokeStyle = pointerColor;
                ctx.stroke();
            },


            play :function(){
                if(this.validar()){
                    document.getElementById('aposta').style.backgroundColor = 'none'
                    this.girarRoleta()  
                    return
                }
                document.getElementById('aposta').style.backgroundColor = 'red'
            },


            finalizar : function(){
                const intervaloAngular = 2 * Math.PI / this.numParts;
                indiceParada = this.ponteiroAngulo / intervaloAngular;
                while(indiceParada > this.numParts){
                    indiceParada -= this.numParts;
                }

                console.log("Parou na cor:", this.identificarCor(indiceParada));            
                this.verificarResultado(indiceParada)
                this.atualizarSaldo()
            },


            verificarResultado : function(intervaloAngular){
                let corApostada = document.getElementById('cor').value
                let corResultado = this.identificarCor(intervaloAngular)
                if( corResultado == corApostada){
                    this.usuarioAcertou = true
                    document.getElementById('resultado-container').setAttribute('style',"display:block")
                    let resultado = document.getElementById('resultado')
                    resultado.setAttribute('style',"display:block")
                    let novoSaldo = this.calcularNovoSaldo()
                    this.novoSaldo = novoSaldo
                    resultado.innerHTML = "<p>Você Ganhou !</p><p>Novo Saldo: R$" + novoSaldo + "</p>"
                    return
                }
                this.usuarioAcertou = false
                document.getElementById('resultado-container').setAttribute('style',"display:block")
                let resultado = document.getElementById('resultado')
                resultado.setAttribute('style',"display:block")
                let novoSaldo = this.calcularNovoSaldo()
                this.novoSaldo = novoSaldo
                resultado.innerHTML = "<p>Você Perdeu !</p><p>Novo Saldo: R$" + novoSaldo + "</p>"
            },

            atualizarSaldo : function(){
                let saldo = this.novoSaldo
                let aposta = document.getElementById('aposta').value;
                let user_id = document.getElementById('user_id').value
                let url = "https://play2win.lndo.site/user/account/updatecash"
                let game_id = document.getElementById('game_id').value
                let dados = {'novoSaldo' : saldo, 'user_id' : user_id, 'won' : this.usuarioAcertou, 'game_id' : game_id, 'alteracao_saldo' : aposta}
                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(url, {
                    method: 'POST', // ou 'GET', 'PUT', 'DELETE', etc.
                    credentials: "same-origin",
                    headers: {
                        'Content-Type': 'application/json', // dependendo do tipo de dados que você está enviando
                        // Outros cabeçalhos personalizados, se necessário
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    body: JSON.stringify(dados), // O corpo da requisição (opcional, depende do tipo de requisição)
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

            identificarCor : function(intervaloAngular){

                if(intervaloAngular < 1.05 && intervaloAngular > 0){
                    return 'black'
                }
                if(intervaloAngular < 2.08 && intervaloAngular >= 1.05){
                    return 'red'
                }
                if(intervaloAngular < 3.14 && intervaloAngular >= 2.08){
                    return 'green'
                }
                if(intervaloAngular < 4.19 && intervaloAngular >= 3.14){
                    return 'orange'
                }
                if(intervaloAngular < 5.25 && intervaloAngular >= 4.19){
                    return 'pink'
                }
                if(intervaloAngular < 6.50 && intervaloAngular >= 5.25){
                    return 'yellow'
                }
                return new Error("Valor Fora de Alcance")
            },


            close : function(){
                document.getElementById('resultado-container').setAttribute('style','display:none');
                document.getElementById('resultado').innerHTML="";
            }
        }

        function desenharRoletaRecursiva (min,max){
            if(min >= max){
                return
            }
            console.log(min)

            Roleta.ponteiroAngulo = min + Math.random()
            Roleta.desenharRoleta()

            setTimeout(function(){
                Roleta.desenharRoletaRecursiva(min+1,max)
            },500)

        }
        
    </script>

    <a href="/user/account/index"> Voltar</a>
    <div>
        <span>Seu Saldo: R$</span>
        <span id="saldo">{{$user->cash}}</span>
    </div>
    <label for="aposta">Valor à apostar</label>
    <input onchange="Roleta.validar(this.value)" type="number" name="aposta" id="aposta">

    <label for="cor">Selecione uma cor</label>
    <select name="cor" id="cor">
        <option value="yellow">Amarelo</option>
        <option value="black">Preto</option>
        <option value="green">Verde</option>
        <option value="red">Vermelho</option>
        <option value="pink">Rosa</option>
        <option value="orange">Laranja</option>
    </select>

    <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}">
    <input type="hidden" id="finished" name="finished" value="false">
    <input type="hidden" id="multiplicador" name="multiplicador" value="{{$game->multiplier}}">
    <input type="hidden" id="game_id" name="game_id" value="{{$game->id}}">

    <button id="confirm" onclick="Roleta.play()">Confirmar!</button>

    <canvas id="roletaCanvas" width="300" height="300" style="border:1px solid #000000;"></canvas>
    
    <div style="display: inline-block">
        
        <div style="display: flex">
            <img src="{{ URL::to('/') }}/seta-direita.png" alt="" style="position: relative; bottom:30px;">
            
            <strong>START</strong>
        </div>
    </div>

    <div style="display: none;width:200px; position:fixed;" id="resultado-container">
        <button style="color:white;border:1px solid red;background-color:red;" onclick="Roleta.close()">X</button>
        <div id="resultado" style="display: none;width:200px;">

        </div>

    </div>

    <script>
        document.addEventListener('load', Roleta.desenharRoleta())
        document.getElementById('finished').addEventListener('change', Roleta.finalizar)
    </script>

</body>
</html>