<div class="modal fade bs-example-modal-lg newReport post{{$post->publicacao_id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">


            <!-- enctype="multipart/form-data" usado para fazer upload para o server -->
            <form role="form"  method="POST" action="/report" accept-charset="UTF-8" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Denuncia do Post: {{$post->publicacao_id}}</h4>
                </div>

                <div class="modal-body">

                    <label for="denuncia_motivo">Motivo da Denuncia</label>
                    <textarea name="denuncia_motivo" id="denuncia_motivo" maxlength="675" placeholder="Digite aqui o motivo da denuncia" class="form-control" rows="6" required="required" style="resize: none;"></textarea>

                    <label for="usuario_id_avaliador">Escolha o avaliador</label>
                    <select name="usuario_id_avaliador" id="usuario_id_avaliador" class="form-control" required="required">
                        @foreach($professores as $prof)
                             <option value="{{$prof->usuario_id}}">{{$prof->usuario_nome}}</option>
                        @endforeach
                    </select>
                    <br>
                    <input type="hidden" name="publicacao_id" id="publicacao_id" class="form-control" value="{{$post->publicacao_id}}" required="required" title="">
                    <input type="hidden" name="comentario_id" id="comentario_id" class="form-control" value="" required="required" title="">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </div>

            </form>


        </div>

    </div>
</div>