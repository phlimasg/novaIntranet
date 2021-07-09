<div class="card card-secondary">
    <div class="card-header">
        <h5 class="card-title"> <i class="fa fa-map"></i> Local de partida do veículo</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <label for="">CEP</label>
                <input type="text" name="cep" id="cep" class="form-control" placeholder="123456-789" data-inputmask="'mask': '99999-999'" inputmode="text">
            </div>
            <div class="col-md-3">
                <label for="">Rua</label>
                <input type="text" name="rua" id="rua" class="form-control" placeholder="Preencha o nome da rua">
            </div>
            <div class="col-md-1">
                <label for="">Nº</label>
                <input type="text" name="numero" id="numero" class="form-control" placeholder="123">
            </div>
            <div class="col-md-3">
                <label for="">Complemento</label>
                <input type="text" name="complemento" class="form-control" placeholder="">
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-2">
                <label for="">Bairro</label>
                <input type="text" name="bairro" id="bairro" class="form-control" placeholder="">
            </div>
            <div class="col-md-2">
                <label for="">Cidade</label>
                <input type="text" name="cidade" id="cidade" class="form-control" placeholder="">
            </div>
            <div class="col-md-1">
                <label for="">UF</label>
                <input type="text" name="estado" id="uf" class="form-control" placeholder="">
            </div>
        </div>   
        <div id="gmap"></div> 
    </div>
</div>
