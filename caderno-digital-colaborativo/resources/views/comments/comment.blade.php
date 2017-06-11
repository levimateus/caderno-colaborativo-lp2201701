<div class="comment row centered">
	<div class="col-md-9">
		<p>Autor({{$comment->usuario_id}}): {{$comment->comentario_conteudo}}</p>
	</div>
	<div class="col-md-3">
		<span class="pull-right"> {{$comment->comentario_pub_dt}}</span>
	</div>
	 <form role="form"  method="POST" action="/like" accept-charset="UTF-8" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <input type="hidden" name="publicacao" value="{{$comment->publicacao_id}}">
        <input type="hidden" name="comentario" value="{{$comment->comentario_id}}">
        <button  class="btn btn-default like btn-login form-control" type="submit" name="like" id="like" value="">
            @php
                $contagemLike = 0;
                $liked = '';
            @endphp
            @if (count($likes) > 0)
	            @foreach ($likes as $like)
	                @if ($like->comentario_id == $comment->comentario_id and $like->publicacao_id == null)
	                    {{$contagemLike + 1}}
	                @endif
	            @endforeach
	            @foreach ($likes as $like)
	            	@if($idUser == $like->usuario_id and $like->publicacao_id == null and $like->comentario_id == $comment->comentario_id)
                        @php
                            $liked = 'liked'
                        @endphp
                 	@endif
                 @endforeach
            @endif
            <i class="fa {{$liked}} fa-heart"></i>
        </button>
    </form>
</div>