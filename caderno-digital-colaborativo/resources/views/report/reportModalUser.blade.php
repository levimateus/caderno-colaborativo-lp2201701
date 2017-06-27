<div class="modal fade bs-example-modal-lg newReport report{{$report->denuncia_id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <!-- enctype="multipart/form-data" usado para fazer upload para o server -->
            <form role="form"  method="POST" action="/report/user" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Punição do autor da denuncia #{{ $report->denuncia_id }}</h4>
                </div>

                <div class="modal-body">
                    <label for="punicao">Escolha o tipo de punição</label>
                    <select name="punicao" id="punicao" class="form-control" required="required">
                             <option value="1">Bloquear acesso</option>
                             <option value="2">Bloquear fazer publicações</option>
                             <option value="3">Bloquear fazer comentários</option>
                    </select>
                    <br>
                    

                    <input type="hidden" name="report_id" id="report_id" class="form-control" value="{{$report->denuncia_id}}" required="required" title="">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </div>

            </form>


        </div>

    </div>
</div>