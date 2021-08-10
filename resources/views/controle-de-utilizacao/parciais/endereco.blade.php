<div class="card card-secondary">
    <div class="card-header">
        <h5 class="card-title"> <i class="fa fa-map"></i> - Para onde vamos?</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <label for="">Sabe o endereço de destino?</label>
                <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" id="chkEndSim" @if (!empty($solicitacao->rua)) checked @endif
                      value="s" @if (old('chkEnd') == "s") checked @endif name="chkEnd" onclick="habilitaCep()">Sim
                    </label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input" 
                      @if (!empty($solicitacao->endereco)) checked @endif
                      value="n" id="chkEndNao" @if (old('chkEnd') == "n") checked @endif name="chkEnd" onclick="habilitaCep()">Não
                    </label>
                  </div>
                    @error('chkEnd')
                        <small class="text-danger">*{{$message}}</small>                        
                    @enderror
            </div>
            <div class="col-md-3">
                <label for="">Destinos pré definidos:</label>
                <select name="" id="destinos" class="form-control ">
                    <option value=""></option>
                    <option value="abelef">La Salle Abel - Ensino Fundamental</option>
                    <option value="abelem">La Salle Abel - Ensino Médio</option>
                    <option value="abelcc">La Salle Abel - Centro Cultural</option>
                    <option value="uni">Unilasalle Rj</option>
                    <option value="uninj">Unilasalle - Núcleo Jurídico</option>
                    <option value="uniceplas">Escola La Salle Rj</option>
                </select>
            </div>
        </div>
        <div class="row"  @if (empty($solicitacao->rua)) id="enderecoCep" @endif>
            <div class="col-md-9">
                <hr>
                <label for="">Ótimo, preencha os campos abaixo:</label>
                <div class="row">
                    <div class="col-md-2">
                        <label for="">CEP</label>
                        <input type="text" name="cep" id="cep" 
                        class="form-control @error('cep') is-invalid @enderror" placeholder="123456-789" data-inputmask="'mask': '99999-999'" inputmode="text" 
                        value="@if (!empty($solicitacao->cep)) {{$solicitacao->cep}} @else {{old('cep')}} @endif">
                        @error('cep')
                            <small class="text-danger">*{{$message}}</small>                        
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="">Rua</label>
                        <input type="text" name="rua" id="rua" class="form-control @error('rua') is-invalid @enderror" placeholder="Preencha o nome da rua" 
                        value="@if (!empty($solicitacao->rua)) {{$solicitacao->rua}} @else {{old('rua')}} @endif">
                        @error('rua')
                            <small class="text-danger">*{{$message}}</small>                        
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <label for="">Nº</label>
                        <input type="text" name="numero" id="numero" class="form-control @error('numero') is-invalid @enderror" placeholder="123" 
                        value="@if (!empty($solicitacao->numero)) {{$solicitacao->numero}} @else {{old('numero')}} @endif">
                        
                    </div>
                    <div class="col-md-3">
                        <label for="">Complemento</label>
                        <input type="text" name="complemento" class="form-control @error('complemento') is-invalid @enderror" placeholder="" 
                        value="@if (!empty($solicitacao->complemento)) {{$solicitacao->complemento}} @else {{old('complemento')}} @endif">
                        @error('complemento')
                            <small class="text-danger">*{{$message}}</small>                        
                        @enderror
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Bairro</label>
                        <input type="text" name="bairro" id="bairro" class="form-control @error('bairro') is-invalid @enderror" placeholder="" 
                        value="@if (!empty($solicitacao->bairro)) {{$solicitacao->bairro}} @else {{old('bairro')}} @endif">
                        @error('bairro')
                            <small class="text-danger">*{{$message}}</small>                        
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control @error('cidade') is-invalid @enderror" placeholder="" 
                        value="@if (!empty($solicitacao->cidade)) {{$solicitacao->cidade}} @else {{old('cidade')}} @endif">
                        @error('cidade')
                            <small class="text-danger">*{{$message}}</small>                        
                        @enderror
                    </div>
                    <div class="col-md-1">
                        <label for="">UF</label>
                        <input type="text" name="estado" id="uf" class="form-control @error('estado') is-invalid @enderror" placeholder="" 
                        value="@if (!empty($solicitacao->estado)) {{$solicitacao->estado}} @else {{old('estado')}} @endif">
                        
                    </div>
                </div> 
            </div>
            <div class="col-md-3">
                <div id="gmap"></div>
            </div>
        </div>
        <div class="row"  @if (empty($solicitacao->endereco)) id="enderecoSemCep" @endif>
            <div class="col-md-12">
                <hr>
                <label for="">Sem problemas, nos explique melhor onde e/ou como chegar ao destino:</label>
                <textarea name="endereco" id="" cols="30" rows="5" class="form-control @error('endereco') is-invalid @enderror" placeholder="Ex: Colégio La Salle Abel, portaria dos fundos."></textarea>
                @error('endereco')
                    <small class="text-danger">*{{$message}}</small>                        
                @enderror
            </div>
        </div>
    </div>
</div>
