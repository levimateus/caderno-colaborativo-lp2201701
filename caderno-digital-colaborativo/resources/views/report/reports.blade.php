@extends('layouts.app')

@section('content')

	@if($reports)
		@foreach($reports as $report)
	   		@if($report->status != 2)
	       		@include('report.report')
	        @endif
	    @endforeach
    @else
    	<h1> Não há nenhuma denuncia para ser avaliada </h1>
    @endif

@endsection