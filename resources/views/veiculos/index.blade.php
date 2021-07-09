@extends('adminlte::page')

@section('title', 'Veículos Cadastrados')

@section('content_header')
<a href="{{ route('veiculos.create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Adicionar Veículo</a>
    <h1>Veículos Cadastrados</h1>
@stop

@section('content')
    <div class="row">
        @forelse ($veiculos as $i)
        <div class="col-md-4">
            <div class="card @if ($i->ativo == 'nao') card-danger @else card-secondary @endif">
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
                            <div class="btn-group-vertical w-100">                            
                                <button type="button" class="btn btn-primary btn-flat btn-block dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                    <span class="fa fa-cog"></span> Opções
                                </button>
                                <div class="dropdown-menu w-100 text-center">
                                    <a class="dropdown-item" href="#"><i class="fa fa-info"></i>  Informações</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-cogs"></i>  Manutenções</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-pen"></i> Editar</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-ban"></i> Desativar</a>
                                </div>
                              </div> 
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
                
            @empty
                Nenhum Veículo cadastrado...
            @endforelse
    </div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop