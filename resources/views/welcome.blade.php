<html lang="pt-BR" data-lt-installed="true" style="height: auto;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veículos - La Salle </title>
    <link rel="stylesheet" href="{{url('/') }}/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{url('/') }}/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{url('/') }}/vendor/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="sidebar-mini" style="height: auto;">
    <style>
        .vh100{
            height: 100vh;           
        }
        .img-fluid-2{
            margin: auto;
            width: 50%;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mx-auto text-center bg-gray-light shadow" style="margin-top: 5%; padding: 15px; border-radius: 2px">                
                <img src="{{ asset('img/vehicles.png') }}" alt="Veículos" class="img-fluid">
                <hr>
                <h3>Agendamento de veículos </h3>
                <h3>La Salle - RJ</h3>
                <a href="{{ route('googleLogin') }}" class="btn btn-danger btn-flat btn-block"> <i class="fab fa-google"></i>  Login</a>
            </div>            
        </div>

    </div>


    <script src="{{url('/') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{url('/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/') }}/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="{{url('/') }}/vendor/adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
