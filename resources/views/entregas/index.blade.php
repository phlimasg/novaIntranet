@extends('adminlte::page')

@section('title', 'Entregas pendentes')

@section('content_header')
<div class="row">
    <div class="col-md-6 mt-1 mb-1">
        <h1> <i class="fa fa-route "></i> Entregas pendentes</h1>
    </div>
    <div class="col-md-3 mt-1 mb-1">
        <button class="btn btn-danger btn-block btn-flat" data-toggle="modal" data-target="#selecionar_veiculo"><i class="fa fa-car"></i> Selecionar Veículo</button> 
    </div>
    <div class="col-md-3 mt-1 mb-1">
        <form action="{{ route('solicitacoes.search') }}" method="post">
            @csrf
            <div class="btn-group btn-block">
              <input type="text" name="search" id="" class="form-control rounded-0" placeholder="Pesquisar" @isset($search)value="{{$search}}" autofocus @endisset onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
              <button type="submit" class="btn btn-default btn-flat" ><i class="fa fa-search"></i> </button>
            </div>
          </form>
    </div>
</div>    
@stop

@section('content')
<div class="row">
    @forelse ($solicitacoes as $i)
        <div class="col-md-12">
            <div class="card @if ($i->status == 'Autorizado') card-success @else card-danger @endif shadow ">
                <div class="card-header">
                <h3 class="card-title">@if ($i->status == 'Autorizado')
                    Entrega disponível
                @else
                    Em rota de entrega
                @endif
                </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="{{url("storage/{$i->veiculo->img_url}")}}" alt="{{$i->veiculo->modelo}}" srcset="" class="img-fluid">                            
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong><i class="fas fa-car mr-1"></i> Veículo</strong>
                                    <p class="text-muted">{{$i->veiculo->modelo}}</p> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Endereço/Rota</strong>
                                     <p class="text-muted">{{$i->rua}}, {{$i->numero}} {{$i->bairro}} {{$i->cidade}} {{$i->estado}}</p>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <strong><i class="fas fa-question-circle mr-1"></i> Motivo/ Material para entrega</strong>
                                    <p class="text-muted">
                                        {{$i->motivo}}
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <img width="50px" src="{{$i->getUser->profile_picture}}" alt="{{$i->getUser->name}} - Foto" class="img-circle float-left mr-3">
                                    <strong><i class="fas fa-user mr-1"></i> Solicitante</strong>
                                    <p>{{$i->getUser->name}}</p>
                                </div>
                            </div>
                        </div>  
                        <div class="col-md-2">
                            <iframe class="img-fluid" style="border:0; width: 100%;" loading="lazy" allowfullscreen 
                            src="https://www.google.com/maps/embed/v1/directions?key={{env("GOOGLE_API_KEY")}}&origin={{$i->veiculo->rua}}, {{$i->veiculo->numero}} {{$i->veiculo->bairro}} {{$i->veiculo->cidade}} {{$i->veiculo->estado}}&destination={{$i->rua}}, {{$i->numero}} {{$i->bairro}} {{$i->cidade}} {{$i->estado}}"></iframe>                            
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <strong><i class="fas fa-map mr-1"></i> Distância</strong>
                            <p class="text-muted">
                                {{number_format(floatval($i->km_estimado/1000),1)}} km
                            </p>                        
                        </div>
                        <div class="col-md-3">
                            <strong><i class="fas fa-clock mr-1"></i> Tempos estimado</strong>
                            <p>{{gmdate("H:i:s", $i->tempo_estimado)}}</p>
                        </div>
                        <div class="col-md-3">
                            <strong><i class="fas fa-stopwatch mr-1"></i> Entregar até</strong>
                            <p>{{date('d/m/Y H:i',strtotime($i->dt_entrega))}}</p>
                        </div>
                        <div class="col-md-3">
                            @if ($i->status == 'Autorizado')
                                <button class="btn btn-success btn-lg btn-flat btn-block" data-toggle="modal" data-target="#entrega_{{$i->id}}"><i class="fab fa-telegram-plane"></i> Sair para entrega</button>
                            @else
                            <button class="btn btn-danger btn-lg btn-flat btn-block" data-toggle="modal" data-target="#fim_entrega_{{$i->id}}"><i class="fab fa-telegram-plane"></i> Finalizar para entrega</button>
                            @endif
                        </div>
                    </div>                    
                </div>
                <!-- /.card-body -->
            </div>
        </div>  
        <!--Modal de FIM entrega-->
        <div class="modal fade" id="fim_entrega_{{$i->id}}">
            <form action="{{ route('entregas.update', ['entrega'=>$i->id]) }}" method="post" onsubmit="mdLoading()">
                @csrf
                @method('PUT')                
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Finalizar entrega</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">                                                    
                        <div class="row">
                           <div class="col-md-6">
                               <label for="">Data/Hora de retorno</label>
                               <input type="text" id="date{{$i->id}}" name="dt_hora_retorno" class="form-control" placeholder="">
                           </div>
                           <div class="col-md-6">
                                <label for="">Km de retorno</label>
                                <input type="text" name="km_final" id="" class="form-control" placeholder="">
                            </div>
                                    
                        </div>                                  
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-flat  btn-success">Confirmar</button>
                        <button type="button" class="btn btn-flat  btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
        <!--Fim Modal de FIM entrega--> 
        <!--Modal de entrega-->
        <div class="modal fade" id="entrega_{{$i->id}}">
            <form action="{{ route('entregas.update', ['entrega'=>$i->id]) }}" method="post" onsubmit="mdLoading()">
                @csrf
                @method('PUT')                
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Sair para entrega</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">                                                    
                        <div class="row">
                           <div class="col-md-6">
                               <label for="">Data/Hora de saída</label>
                               <input type="text" name="dt_hora_saida" id="date{{$i->id}}" class="form-control" placeholder="">
                           </div>
                           <div class="col-md-6">
                                <label for="">Km de saída</label>
                                <input type="text" name="km_inicial" id="" class="form-control" placeholder="">
                            </div>
                                    
                        </div>                                  
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-flat  btn-success">Confirmar </button>
                        <button type="button" class="btn btn-flat  btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
        <!--Fim Modal de entrega-->      
      @empty
        Nenhuma entrega disponível
    @endforelse
        <!--Modal de veiculo-->
        <div class="modal fade" id="selecionar_veiculo">
            <form action="{{ route('entregas.show', ['entrega'=>$i->id]) }}" method="post" onsubmit="mdLoading()">
                @csrf
                @method('PUT')                
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                        <h4 class="modal-title">Selecione o veículo</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <!-- Modal body -->
                        <div class="modal-body">                        
                            Selecione o veículo:
                        <div class="row">
                            @foreach ($veiculos as $i)
                                <div class="col-md-4 m-2">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <img src="{{url("storage/{$i->img_url}")}}" alt="{{$i->modelo}}" srcset="" class="img-fluid">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="">Veículo:</label>
                                            <p>{{$i->modelo}}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{ route('entregas.show', ['entrega'=>$i->id]) }}" class="btn btn-primary btn-flat btn-block">Selecionar Veículo</a>
                                        </div>
                                    </div>
                                  </div>  
                                                              
                            @endforeach
                                    
                        </div>                                  
                        </div>
                        
                        <!-- Modal footer -->
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-flat  btn-success">Confirmar Autorização</button>
                        <button type="button" class="btn btn-flat  btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
        <!--Fim Modal de veiculo-->
</div>
@include('parciais.mdLoading')
@stop

@section('css')
    <style>
        .dataTables_length {
          padding: 15px 0 0px 15px;
        }
        .dataTables_info{
          padding: 15px 0 15px 15px;
        }
        .pagination{
          padding: 0px 15px 0px 0px;
        }
        td{
            vertical-align: middle !important; 
        }
    </style>
@stop

@section('js') 

<script>
    function mdLoading() {
        $("#modalLoading").modal("show");        
    }
    //Habilita o calendÃ¡rio
    function calendario(id){
        $('#'+id).datetimepicker({
            daysOfWeekDisabled: [0, 6],
            inline: true,
            sideBySide: true,
            defaultDate: new Date(),            
            //disabledDates: [ new Date(),],
            minDate: new Date(),
    
        });
    }
    @foreach($solicitacoes as $i)
        calendario('date{{$i->id}}');
    @endforeach
</script>
    
@stop