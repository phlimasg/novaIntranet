<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: darkgray; font-family: Arial, Helvetica, sans-serif">
    <div style="margin: 0 auto; max-width: 600px; background-color: white; ">
        <div style="background-color: #004F97">
            <img src="https://lasalle.edu.br/public/images/logo.png" alt="" style="padding: 15px 0px 0px 15px" width="250px">
        </div>
        <div style="background-color: white; text-align: center">
            <img src="{{ url('img/vehicles.png') }}" alt="" srcset="" style="width:60%">            
            
        </div>
        <div style="padding:10px">
            <hr>
            <h3 align="center">Nova solicitação</h3>
            <hr>
            <br>
            <p><b>Quem solicitou: </b> {{$utilizacao->getUser->name}}</p>
            <p><b>Solicitação: </b> {{$utilizacao->motivo}}</p>
            <p><b>Status: </b> {{$utilizacao->status}}</p>
            <p><b>Data para entrega até: </b>{{date('d/m/Y H:i',strtotime($utilizacao->dt_entrega))}}</p>
            <p><b>Onde será entregue: </b>{{empty($utilizacao->endereco) ? $utilizacao->rua.', '.$utilizacao->numero.' - '.$utilizacao->bairro.' - '.$utilizacao->cidade. ' - '.$utilizacao->estado : $utilizacao->endereco}}</p>

            <div style="width: 100%; margin: 50px 0px 50px 0px;">
                <a href="{{ url('/') }}" style="
                font-weight: 400;                
                text-align: center;
                vertical-align: middle;                
                user-select: none;                
                border: 1px solid transparent;
                padding: .375rem 1rem;
                font-size: 1rem;
                line-height: 1.5;                
                transition: color .15s;
                color: #fff;
                background-color: #28a745;
                border-color: #28a745;
                box-shadow: none;
                display: block;                
                border-radius: 0;
                max-width:600px;
                text-decoration: none;
                ">
                    Acessar o Sistema
                </a>
            </div>
            <div style="text-align: center">
                <small><b>Agendamento de veículos | La Salle - RJ</b></small>
            </div>
        </div>
    </div>
</body>
</html>