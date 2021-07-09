@extends('adminlte::page')

@section('title', 'Nova Solicitação')

@section('content_header')
<a href="{{ route('controle-de-utilizacao.index') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> Minhas solicitações</a>
    <h1> <i class="fa fa-user-plus "></i>  Nova Solicitação</h1>
@stop

@section('content')
<form action="{{ route('controle-de-utilizacao.store') }}" method="post" id="form">
    @csrf
    <div class="row">
        <div class="col-md-12" >
            <div class="card card-secondary" style="">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-question-circle"></i> - O que iremos buscar/levar?</h3>                    
                </div>
                <div class="card-body">
                    <label for="">Descreva, em poucas palavras, o motivo da solicitação:</label>
                    <textarea name="motivo" id="" cols="30" rows="3" class="form-control  @error('motivo') is-invalid @enderror" placeholder="Ex: Buscar uma estante e um armário no abel.">{{old('motivo')}}</textarea>
                    @error('motivo')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-secondary">
                <div class="card-header">
                    <h5 class="card-title"><i class="fas fa-calendar-week"></i> - Qual o prazo?</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Até quando deve ser entregue?</label>
                            <div style="overflow:hidden;">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <input type="text" value="{{old('data')}}" name="data" id="datetimepicker" hidden>
                                            @error('data')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <h4>Selecione o veículo mais adequado pra você:</h4>
    <div class="row">
        <input type="text" name="veiculo_id" id="veiculo_id" value="" style="display: none" >
        @forelse ($veiculos as $i)
        
        <div class="col-md-4">
            <div class="card card-secondary" id="veiculo{{$i->id}}">
                <div class="card-header">
                    <h3 class="card-title"> <i class="fa fa-truck"></i> - {{$i->modelo}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img src="{{url("storage/{$i->img_url}")}}" alt="" srcset="" class="img-fluid img-circle">
                        </div>
                        <div class="col-md-7">
                            <label for="">Placa: </label> {{$i->placa}} <br>
                            <label for="">Renavam: </label> {{$i->renavam}}<br>
                            <label for="">Km: </label> {{$i->km}} <br>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" id="btnveiculo{{$i->id}}" class="btn btn-primary btn-flat btn-block" data-toggle="dropdown" onclick="veiculo({{$i->id}}, '{{$i->modelo}}')">
                                <span class="fa fa-check"></span> Selecionar Veículo
                            </button>                                                                    
                        </div>                       
                    </div>
                </div>
                </div>
        </div>                    
        @empty
            Nenhum Veículo disponível...
        @endforelse
    </div>
    @error('veiculo_id')
        <small class="text-danger">*{{$message}}</small>
    @enderror

    <div class="row">
        <div class="col-md-12">
            @include('controle-de-utilizacao.parciais.endereco')
        </div>
    </div>
    @isset(Auth::user()->coordenador)
    
    <div class="row pb-5">

        <div class="col-md-12">
            <button type="submit" class="btn btn-flat btn-success btn-block">Solicitar</button>
        </div>
    </div>
    @else
        <div class="row">
            <div class="col-md-12">
                <button type="button"class="btn btn-flat btn-success btn-block" data-toggle="modal" data-target="#myModal">Solicitar</button>
            </div>
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Ooops...</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">                        
                       <div class="row">
                           <div class="col-md-12">
                            <p>Vimos que você não tem o perfil de coordenador e para continuar, preciso que me informe o endereço de e-mail dele para que ele confirme e autorize sua solicitação.</p>
                           </div>
                       </div>
                       <div class="row">
                           <label for="">E-mail do seu coordenador:</label>
                           <input type="text" name="coordenador_email" id="" class="form-control @error('coordenador_email') is-invalid @enderror" placeholder="email.do.coordenador@lasalle.org.br" value="{{old('coordenador_email')}}">
                           @error('coordenador_email')
                                <small class="text-danger">*{{$message}}</small>                               
                            @enderror
                       </div>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-flat btn-block btn-success">Finalizar solicitação</button>
                    </div>
                    
                  </div>
                </div>
              </div>
        </div>

    @endisset
    </form>
    @include('parciais.mdLoading')
@stop

@section('css')
    <style>
        
    </style>
@stop

@section('js') 
<script src="{{ asset('js/scripts.js') }}"></script>
@error('coordenador_email')    
    <script>
        $("#myModal").modal("show");
    </script>
@enderror 

@if (old('chkEnd') == "s") 
    <script>
        habilitaCep();
    </script>
@elseif(old('chkEnd') == "n")
<script>
    habilitaCep();
</script>
@endif  
    <script>     
        var veiculo_selecionado = null;
        function veiculo(id, modelo = null) {
            var veiculo = "veiculo" + id;
            if(veiculo_selecionado != null){
                $("#"+veiculo_selecionado).removeClass("card-success");
                $("#"+veiculo_selecionado).addClass("card-secondary");
                $("#btn"+veiculo_selecionado).removeClass("disabled");
            }
            //alert(veiculo);
            $("#"+veiculo).removeClass("card-secondary");
            $("#"+veiculo).addClass("card-success");
            $("#btn"+veiculo).addClass("disabled");
            $("#veiculo_id").val(id);            
            veiculo_selecionado = veiculo;
            toastr.success(modelo + ' selecionado com sucesso!');
        }
        $("#numero").change(function() {
            $('#gmap').empty();   
            $('#gmap').append('<iframe class="mt-3" width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?key={{env("GOOGLE_API_KEY")}}&q='+$("#rua").val()+'+'+$("#numero").val()+'+'+$("#bairro").val()+'+'+$("#cidade").val()+'+'+$("#uf").val()+'"></iframe>');
        });
        
    </script>
    
@stop