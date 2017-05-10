@extends('layouts.app')

@section('content')
<br><br><br><br>


<form role="form"  method="POST" action="/importar" accept-charset="UTF-8" enctype="multipart/form-data">
    {{ csrf_field() }}
    <legend>Form title</legend>
    <div class="form-group">
        <input type="file" name="arquivo" id="arquivo" />
    </div>
    

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
