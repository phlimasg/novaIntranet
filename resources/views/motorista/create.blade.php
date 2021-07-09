@extends('adminlte::page')

@section('title', 'Cadastrar Veículo')

@section('content_header')
<a href="{{ route('motoristas.index') }}" class="btn btn-danger float-right"><i class="fa fa-undo-alt"></i> Voltar</a>
    <h1>Cadastrar Veículo</h1>
@stop

@section('content')
<form action="{{ route('motoristas.store') }}" method="post" enctype="multipart/form-data">
    <div class="card">
        <div class="card-body">
             
            <div class="card card-secondary">
                 <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-car"></i> Dados do motorista</h5>
                 </div>
                 <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Nome</label>
                            <input type="text" name="name" id="fabricante" class="form-control   @error('name') is-invalid  @enderror" value="@isset($motorista->name) {{$motorista->name}} @else {{old('name')}} @endisset">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                            
                        </div>
                        <div class="col-md-6">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" value="@isset($motorista->email) {{$motorista->email}} @else {{old('email')}} @endisset" class="form-control  @error('email') is-invalid  @enderror ">                                
                            @error('email')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>                        
                    </div>                    
                   
                </div>
                 
             </div>            
            <div class="card-footer">
                <button class="btn btn-primary btn-flat btn-block" type="submit"> <i class="fa fa-save"></i> Adicionar motorista</button>
            </div>
        </div>
    </form>
@stop

@section('css')
    
@stop

@section('js')
    
@stop
