@extends('adminlte::page')

@section('title', 'Veículos Cadastrados')

@section('content_header')
<a href="{{ route('usuarios.create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Adicionar usuarios</a>
    <h1>Usuários - Administradores do Sistema</h1>
@stop

@section('content')
    <div class="row">
        @forelse ($usuarios as $i)
        <div class="col-md-4">
            <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-danger">
                <div class="widget-user-image">
                    @isset($i->profile_picture)
                        <img class="img-circle elevation-2" src="{{$i->profile_picture}}" alt="User Avatar">
                    @else
                        <img class="img-circle elevation-2" src="{{ asset('img/user.png') }}" alt="User Avatar">
                    @endisset
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">{{$i->name}}</h3>
                <h5 class="widget-user-desc" style="font-size: 14px;">{{$i->email}}</h5>
              </div>
              <!--
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Projects <span class="float-right badge bg-primary">31</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Tasks <span class="float-right badge bg-info">5</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Completed Projects <span class="float-right badge bg-success">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Followers <span class="float-right badge bg-danger">842</span>
                    </a>
                  </li>
                </ul>
              </div>
            -->
              <div class="card-footer">
                  <div class="row">                      
                        <div class="col-md-12">
                            <a data-toggle="modal" data-target="#modal{{$i->id}}" href="#" class="btn btn-danger btn-block"><i class="fa fa-ban"></i> Remover</a>
                        </div>
                  </div>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
        
        <!-- The Modal -->
        <div class="modal fade" id="modal{{$i->id}}">
            <form action="{{ route('usuarios.destroy', ['usuario'=>$i->id]) }}" method="post">
                @csrf
                @method('delete')
            
                <div class="modal-dialog">
                <div class="modal-content">
                
                    <!-- Modal Header -->
                    <div class="modal-header">
                    <h4 class="modal-title">Excluir usuarios?</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                    Deseja realmente excluir do usuarios <b>{{$i->name}}</b>?
                    <small><p>*Para reativar, entre em contato com o suporte.</p></small>
                    </div>
                    
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>
                    
                </div>
                </div>
            </form>
        </div>

        @empty
            Nenhum usuarios cadastrado...
        @endforelse
    </div>
@stop

@section('css')
    
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop