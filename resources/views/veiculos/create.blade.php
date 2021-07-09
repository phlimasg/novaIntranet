@extends('adminlte::page')

@section('title', 'Cadastrar Veículo')

@section('content_header')
<a href="{{ route('veiculos.index') }}" class="btn btn-danger float-right"><i class="fa fa-undo-alt"></i> Voltar</a>
    <h1>Cadastrar Veículo</h1>
@stop

@section('content')
<form action="{{ route('veiculos.store') }}" method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-body">
             
            <div class="card card-secondary">
                 <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-car"></i> Dados do veículo</h5>
                 </div>
                 <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Tipo</label>                        
                            <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid  @enderror js-example-basic-single">
                                <option value=""></option>
                                <option value="carros">Carro</option>
                                <option value="caminhoes">Caminhão</option>
                                <option value="motos">Motocicleta</option>
                            </select>
                            @error('tipo')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="">Fabricante</label>
                            <select name="fabricante" id="fabricante" class="form-control  js-example-basic-single @error('fabricante') is-invalid  @enderror">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Modelo</label>
                            <select name="modelo" id="modelo" class="form-control  @error('modelo') is-invalid  @enderror js-example-basic-single">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Ano</label>
                            <select name="ano" id="ano" class="form-control  @error('ano') is-invalid  @enderror js-example-basic-single">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Placa</label>
                            <input type="text" name="placa" id="" class="form-control  @error('placa') is-invalid  @enderror" placeholder="kxf-2555" data-inputmask="'mask': 'AAA-9*99'" inputmode="text">                        
                        </div>
                        <div class="col-md-3">
                            <label for="">Renavam</label>
                            <input type="text" name="renavam" id="" class="form-control  @error('renavam') is-invalid  @enderror" placeholder="">                        
                        </div>
                        <div class="col-md-3">
                            <label for="">Kilometragem</label>
                            <input type="text" name="km" id="" class="form-control  @error('km') is-invalid  @enderror" placeholder="">                        
                        </div>
                        <div class="col-md-3">
                            <label for="">Ativo/Disponível</label>
                            <select name="ativo" id="" class="form-control  @error('ativo') is-invalid  @enderror">
                                <option value=""></option>    
                                <option value="sim">Sim</option>    
                                <option value="nao">Não</option>    
                            </select>                 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Foto Illustrativa do Veículo</label>
                            <input type="file" name="img_url" id="" class="form-control  @error('img_url') is-invalid  @enderror">
                            @error('img_url')
                                <small class="text-danger">*{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                 
             </div>
            @include('veiculos.parciais.endereco')
            <div class="card-footer">
                <button class="btn btn-primary btn-flat btn-block" type="submit"> <i class="fa fa-save"></i> Adicionar Veículo</button>
            </div>
        </div>
    </form>
@stop

@section('css')
    
@stop

@section('js')
    <script>
        
        $("#numero").change(function() {
            $('#gmap').empty();   
            $('#gmap').append('<iframe class="mt-3" width="100%" height="450" style="border:0" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?key={{env("GOOGLE_API_KEY")}}&q='+$("#rua").val()+'+'+$("#numero").val()+'+'+$("#bairro").val()+'+'+$("#cidade").val()+'+'+$("#uf").val()+'"></iframe>');
        });
  </script> 
  
  
  <script src="{{ asset('js/scripts.js') }}"></script>
@stop
