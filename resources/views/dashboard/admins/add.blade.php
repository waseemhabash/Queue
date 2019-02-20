@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/admins') }}" method="post" >	
	@csrf
	@php
	bs_input("name",null,true);
	bs_input("email",null,true);
	bs_number("phone",null,false)
	@endphp

	<div class="form-group">
		<label for=" col-sm-1 form-field-select-4">
			<?= __("dashboard.role") ?>
		</label>
		<div class="col-sm-6">
			<select name="roles[]" multiple="multiple" id="form-field-select-4" class="form-control search-select">
				@foreach ($roles as $role) 
				<option value="{{$role->id}}">{{$role->name}}</option>    
				@endforeach
			</select>
		</div>
	</div>
	@php
	bs_password("password",null,true);
	bs_password("rePassword",null,true);

	@endphp
	<button type="submit" class="btn btn-primary">save</button>
</form>
@endsection