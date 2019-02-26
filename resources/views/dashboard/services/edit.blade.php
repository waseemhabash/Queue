@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/services/'.$service->id) }}" method="post" class="form-horizontal" >	
	@csrf
	@method('PATCH')
	@php
	bs_input("name",$service->name,true);
	bs_text("description",$service->description,true);
	
	@endphp

	
	{{bs_save("save")}}
</form>
@endsection 