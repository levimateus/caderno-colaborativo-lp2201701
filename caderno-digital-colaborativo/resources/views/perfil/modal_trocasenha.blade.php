<div class="modal fade perfil-trocasenha-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            
            <!-- enctype="multipart/form-data" usado para fazer upload para o server -->
            <form id="form-change-password" role="form" method="POST" action="{{ url('/usuario/trocasenha') }}" novalidate class="form-horizontal">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar senha</h4>
                </div>

                <div class="col-md-9">             
                    <label for="current-password" class="col-sm-4 control-label">Senha Atual</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                            <input type="password" class="form-control" id="current-password" name="current-password" placeholder="Senha Atual">
                        </div>
                    </div>
                    <label for="password" class="col-sm-4 control-label">Nova senha</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Nova senha">
                        </div>
                    </div>
                    <label for="password_confirmation" class="col-sm-4 control-label">Confirme a nova senha</label>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirme a nova senha">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-6">
                        <button type="submit" class="btn btn-success">Confirmar</button>
                    </div>
                </div>
            </form>


        </div>

    </div>
</div>
