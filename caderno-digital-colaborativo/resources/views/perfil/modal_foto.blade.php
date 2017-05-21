<div class="modal fade perfil-foto-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <!-- enctype="multipart/form-data" usado para fazer upload para o server -->
            <form role="form"  method="POST" action="/perfil/trocarFoto" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modificar foto</h4>
                </div>

                <div class="modal-body">
                    <label for="midia" class="col-sm-2">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control" value="" required="required" title="">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>

            </form>


        </div>

    </div>
</div>