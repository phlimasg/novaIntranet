<div class="modal fade" id="modalLoading">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Aguarde. Salvando dados....</h4>          
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">                        
            <div class="row">
                <div class="col-md-12">
                    <p>{{Auth::user()->name}}, aguarde enquanto salvamos seus dados e notificamos o setor responsável.</p>
                </div>
            </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button class="btn btn-primary btn-block btn-flat" disabled>
                    <span class="spinner-border spinner-border-sm"></span>
                    Salvando dados..
                </button>
            </div>
            
        </div>
    </div>
</div>