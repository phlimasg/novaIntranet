@extends('adminlte::page')

@section('title', 'Minhas Solicitações')

@section('content_header')
<div class="float-right">
  <form action="{{ route('solicitacoes.search') }}" method="post">
    @csrf
    <div class="btn-group">
      <input type="text" name="search" id="" class="form-control" placeholder="Pesquisar" @isset($search)value="{{$search}}" autofocus @endisset onfocus="var temp_value=this.value; this.value=''; this.value=temp_value">
      <button type="submit" class="btn btn-default" ><i class="fa fa-search"></i> </button>

    </div>
  </form>
</div>
    <h1> <i class="fa fa-list "></i> Todas as Solicitações</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Listagens de solicitações</h3>
            <div class="card-tools">
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0 table-responsive">
            <table class="table table-hover table-dark table-striped table-head-fixed" id="myTable">
              <thead>
                <tr>                  
                  <th>Motivo</th>
                  <th>Status</th>
                  <th>Usuário</th>
                  <th style="width: 150px">Entregar até</th>
                </tr>
              </thead>
              <tbody>
                  @forelse ($solicitacoes as $i)
                    <tr data-widget="expandable-table" aria-expanded="false">                        
                        <td>{{$i->motivo}}</td>
                        <td>{{$i->status}}</td>
                        <td>{{$i->getUser->name}}</td>
                        <td>{{date('d/m/Y H:i',strtotime($i->created_at))}}</td>
                    </tr>
                    <tr class="expandable-body">
                        <td colspan="5" class="bg-secondary">
                          <div class="row">
                                <div class="col-md-2">
                                    <label for="">Saída:</label>
                                    <p>{{!empty($i->dt_hora_saida)??date('d/m/Y H:i',strtotime($i->dt_hora_saida))}}</p>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Retorno:</label>
                                    <p>{{!empty($i->dt_hora_retorno)??date('d/m/Y H:i',strtotime($i->dt_hora_retorno))}}</p>
                                </div>
                                <div class="col-md-2">
                                    <label for="">KM de Saída:</label>
                                    <p>{{$i->km_inicial}}</p>
                                </div>
                                <div class="col-md-2">
                                    <label for="">KM de Volta:</label>
                                    <p>{{$i->km_final}}</p>
                                </div>
                                <div class="col-md-2">
                                    <label for="">KM de Percorrido:</label>
                                    <p>{{$i->percorrido}}</p>
                                </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2">
                                  <img src="{{url("storage/{$i->veiculo->img_url}")}}" alt="{{$i->veiculo->modelo}}" srcset="" class="img-fluid">
                              </div>
                              <div class="col-md-2">
                                  <label for="">Veículo:</label>
                                  <p>{{$i->veiculo->modelo}}</p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12">
                                <p>
                                    {{$i->rua}}, {{$i->numero}} @isset($i->complemento) - {{$i->complemento}} @endisset  - {{$i->bairro}} - {{$i->cidade}} - {{$i->estado}}
                                </p>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-12" style="height: 500px;">
                                <!--<iframe class="mt-3" width="100%" height="100%" style="border:0;" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed/v1/place?key={{env("GOOGLE_API_KEY")}}&origin={{$i->veiculo->rua}}+{{$i->veiculo->numero}}+{{$i->veiculo->cidade}}+{{$i->veiculo->estado}}destination={{$i->rua}}+{{$i->numero}}+{{$i->bairro}}+{{$i->cidade}}+{{$i->estado}}"></iframe>-->
                              </div>
                          </div>
                        </td>
                      </tr>
                  @empty
                      Nada cadastrado pra mostrar...
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
        .dataTables_length {
          padding: 15px 0 0px 15px;
        }
        .dataTables_info{
          padding: 15px 0 15px 15px;
        }
        .pagination{
          padding: 0px 15px 0px 0px;
        }
    </style>
@stop

@section('js') 
<script>
  /*$('#myTable').DataTable({
    "searching": false,
    "order": [],
    "language": {
          "emptyTable": "Nenhum registro encontrado",
          "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
          "infoEmpty": "Mostrando 0 até 0 de 0 registros",
          "infoFiltered": "(Filtrados de _MAX_ registros)",
          "infoThousands": ".",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "zeroRecords": "Nenhum registro encontrado",
          "search": "Pesquisar",
          "paginate": {
              "next": "Próximo",
              "previous": "Anterior",
              "first": "Primeiro",
              "last": "Último"
          },
          "aria": {
              "sortAscending": ": Ordenar colunas de forma ascendente",
              "sortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
              "rows": {
                  "_": "Selecionado %d linhas",
                  "0": "Nenhuma linha selecionada",
                  "1": "Selecionado 1 linha"
              },
              "1": "%d linha selecionada",
              "_": "%d linhas selecionadas",
              "cells": {
                  "1": "1 célula selecionada",
                  "_": "%d células selecionadas"
              },
              "columns": {
                  "1": "1 coluna selecionada",
                  "_": "%d colunas selecionadas"
              },
              "0": "Nenhuma linha selecionada"
          },
          "buttons": {
              "copySuccess": {
                  "1": "Uma linha copiada com sucesso",
                  "_": "%d linhas copiadas com sucesso"
              },
              "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
              "colvis": "Visibilidade da Coluna",
              "colvisRestore": "Restaurar Visibilidade",
              "copy": "Copiar",
              "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
              "copyTitle": "Copiar para a Área de Transferência",
              "csv": "CSV",
              "excel": "Excel",
              "pageLength": {
                  "-1": "Mostrar todos os registros",
                  "1": "Mostrar 1 registro",
                  "_": "Mostrar %d registros"
              },
              "pdf": "PDF",
              "print": "Imprimir"
          },
          "autoFill": {
              "cancel": "Cancelar",
              "fill": "Preencher todas as células com",
              "fillHorizontal": "Preencher células horizontalmente",
              "fillVertical": "Preencher células verticalmente"
          },
          "lengthMenu": "Exibir _MENU_ resultados por página",
          "searchBuilder": {
              "add": "Adicionar Condição",
              "button": {
                  "0": "Construtor de Pesquisa",
                  "_": "Construtor de Pesquisa (%d)"
              },
              "clearAll": "Limpar Tudo",
              "condition": "Condição",
              "conditions": {
                  "date": {
                      "after": "Depois",
                      "before": "Antes",
                      "between": "Entre",
                      "empty": "Vazio",
                      "equals": "Igual",
                      "not": "Não",
                      "notBetween": "Não Entre",
                      "notEmpty": "Não Vazio"
                  },
                  "number": {
                      "between": "Entre",
                      "empty": "Vazio",
                      "equals": "Igual",
                      "gt": "Maior Que",
                      "gte": "Maior ou Igual a",
                      "lt": "Menor Que",
                      "lte": "Menor ou Igual a",
                      "not": "Não",
                      "notBetween": "Não Entre",
                      "notEmpty": "Não Vazio"
                  },
                  "string": {
                      "contains": "Contém",
                      "empty": "Vazio",
                      "endsWith": "Termina Com",
                      "equals": "Igual",
                      "not": "Não",
                      "notEmpty": "Não Vazio",
                      "startsWith": "Começa Com"
                  },
                  "array": {
                      "contains": "Contém",
                      "empty": "Vazio",
                      "equals": "Igual à",
                      "not": "Não",
                      "notEmpty": "Não vazio",
                      "without": "Não possui"
                  }
              },
              "data": "Data",
              "deleteTitle": "Excluir regra de filtragem",
              "logicAnd": "E",
              "logicOr": "Ou",
              "title": {
                  "0": "Construtor de Pesquisa",
                  "_": "Construtor de Pesquisa (%d)"
              },
              "value": "Valor"
          },
          "searchPanes": {
              "clearMessage": "Limpar Tudo",
              "collapse": {
                  "0": "Painéis de Pesquisa",
                  "_": "Painéis de Pesquisa (%d)"
              },
              "count": "{total}",
              "countFiltered": "{shown} ({total})",
              "emptyPanes": "Nenhum Painel de Pesquisa",
              "loadMessage": "Carregando Painéis de Pesquisa...",
              "title": "Filtros Ativos"
          },
          "searchPlaceholder": "Digite um termo para pesquisar",
          "thousands": ".",
          "datetime": {
              "previous": "Anterior",
              "next": "Próximo",
              "hours": "Hora",
              "minutes": "Minuto",
              "seconds": "Segundo",
              "amPm": [
                  "am",
                  "pm"
              ],
              "unknown": "-"
          },
          "editor": {
              "close": "Fechar",
              "create": {
                  "button": "Novo",
                  "submit": "Criar",
                  "title": "Criar novo registro"
              },
              "edit": {
                  "button": "Editar",
                  "submit": "Atualizar",
                  "title": "Editar registro"
              },
              "error": {
                  "system": "Ocorreu um erro no sistema (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Mais informações<\/a>)."
              },
              "multi": {
                  "noMulti": "Essa entrada pode ser editada individualmente, mas não como parte do grupo",
                  "restore": "Desfazer alterações",
                  "title": "Multiplos valores",
                  "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens para esta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais."
              },
              "remove": {
                  "button": "Remover",
                  "confirm": {
                      "_": "Tem certeza que quer deletar %d linhas?",
                      "1": "Tem certeza que quer deletar 1 linha?"
                  },
                  "submit": "Remover",
                  "title": "Remover registro"
              }
          },
          "decimal": ","
        }
  });*/
</script>
    
@stop