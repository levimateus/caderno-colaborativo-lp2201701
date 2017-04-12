@extends('layouts.app')

@section('content')
<br><br><br><br>


<form action="importar" method="POST" role="form">
    {{ csrf_field() }}
    <legend>Form title</legend>

    <div class="form-group">
        <label for="">label</label>
        <input type="text" class="form-control" id="" placeholder="Input field">

    <div class="form-group">
        <input type="file" name="arquivo" id="arquivo" />
    </div>
    

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
