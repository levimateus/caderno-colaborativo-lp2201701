@extends('layouts.app')

@section('content')

	@if($reports)
		@foreach($reports as $report)
	   		@if($report->status == 1)
	       		@include('report.report')
	        @endif
	    @endforeach
    @else
    	<h1> Não há nenhuma denuncia para ser avaliada </h1>
    @endif

@endsection