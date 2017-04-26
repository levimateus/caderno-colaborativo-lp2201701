<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">


			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Novo Post</h4>
			</div>

			<div class="modal-body">

			<label for="descricao" class="col-sm-2">Descrição</label>
				<textarea name="descricao" id="descricao" maxlength="675" placeholder="675 caracteres..." class="form-control" rows="6" required="required" style="resize: none;"></textarea>
				<br>
				<label for="area" class="col-sm-2">Área</label>
				<select name="area" id="area" class="form-control" required="required">
					<option value=""></option>
				</select>
				<br>
				<label for="professor" class="col-sm-2">Professor</label>
				<select name="professor" id="professor" class="form-control" required="required">
					<option value=""></option>
				</select>
				<br>
				<label for="tags" class="col-sm-2">Tags</label>
				<input type="text" name="tags" id="inputTags" class="form-control" value="" required="required" pattern="" title="">

				<label for="midia" class="col-sm-2">Mídia</label>
				<input type="file" name="midia" id="midia" class="form-control" value="" required="required" pattern="" title="">




			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				<button type="button" class="btn btn-primary">Publicar</button>
			</div>



		</div>
	</div>
</div>