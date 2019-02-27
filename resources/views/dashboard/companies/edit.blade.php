@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/companies/'.$company->id) }}" method="post" class="form-horizontal" >	
	@csrf
	@method('PATCH')
	@php
	bs_input("name",$company->name,true);
	bs_text("description",$company->description,true);
	bs_number("phone",$company->phone,false)
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