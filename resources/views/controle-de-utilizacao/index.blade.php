@extends('adminlte::page')

@section('title', 'Minhas Solicitações')

@section('content_header')
<a href="{{ route('controle-de-utilizacao.create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Nova solicitação</a>
    <h1> <i class="fa fa-list "></i> Minhas Solicitações</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Listagens de solicitações</h3>
            <div class="card-tools">
              {{ $solicitacoes->links() }}
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-dark table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Descrição</th>
                  <th>Status</th>
                  <th>Usuário</th>
                  <th style="width: 150px">Data</th>
                </tr>
              </thead>
              <tbody>
                  @forelse ($solicitacoes as $i)
                    <tr>
                        <td>{{$i->id}}</td>
                        <td>{{$i->motivo}}</td>
                        <td>{{$i->status}}</td>
                        <td>{{$i->getUser->name}}</td>
                        <td>{{date('d/m/Y H:i',strtotime($i->created_at))}}</td>
                    </tr>
                  @empty
                      Nada cadastrado...
                  @endforelse
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
</div>
@stop

@section('css')
    <style>
        
    </style>
@stop

@section('js') 

    
@stop