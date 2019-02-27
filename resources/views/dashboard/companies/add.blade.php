@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/companies') }}" method="post" class="form-horizontal" >	
	@csrf
	@php
	bs_input("name",null,true);
	bs_text("description",null,true);
	bs_number("phone",null,false)
	@endphp

	<div class="form-group">
		<label for=" col-sm-1 form-field-select-4">
			<?= __("dashboard.owner") ?>
		</label>
		<div class="col-sm-6">
			<select name="user_id" multiple="multiple" id="form-field-select-3" 
			        class="form-control search-select">
				@foreach ($users as $user) 
				<option value="{{$user->id}}">{{$user->name}}</option>    
				@endforeach
			</select>
		</div>
	</div>

	{{bs_save("save")}}
</form>
@endsection 