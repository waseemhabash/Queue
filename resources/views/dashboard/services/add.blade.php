@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/services') }}" method="post" class="form-horizontal" >	
	@csrf
	@php
	bs_input("name",null,true);
	bs_text("description",null,true);
	
	@endphp

	

	{{bs_save("save")}}
</form>
@endsection 