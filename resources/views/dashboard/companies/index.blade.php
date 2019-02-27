@extends('dashboard.layouts.index')

@section('content')
<a href="{{ url('dashboard/companies/create') }}">
	<button class="btn btn-success">
		<i class="fa fa-plus "></i>{{__("dashboard.addX",["X"=>__("dashboard.company")])}}
	</button>
</a>

<table class="table table-hover" id="sample-table-1">
	<thead>
		<tr>
			<th class="center">#</th>
			

			<th>{{__("dashboard.name")}}</th>
			<th >{{__("dashboard.owner")}}</th>
			<th >{{__("dashboard.phone")}}</th>
			<th>{{__("dashboard.description")}}</th>

			<th>{{ __("dashboard.options") }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($companies as $company)
		<tr>
			<td class="center">{{$company->id}}</td>
			<td>{{$company->name}}</td>
			
			<td>{{$company->owner($company->user_id)}}</td>
			<td>{{$company->phone}}</td>
			<td>{!!$company->description!!}</td>
			<td>
				<a href='{{ url("dashboard/companies/$company->id/edit") }}' class="btn btn-xs btn-teal tooltips"
					data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i></a>
					<form class="delete-company" action='{{ url("/dashboard/companies/$company->id") }}' method="POST" style="display:inline">
						@csrf
						@method("delete")
						<button class="btn btn-xs btn-bricky tooltips" data-placement="top" 
						data-original-title="{{__('dashboard.delete')}}">
						<i class="fa fa-times fa fa-white"></i></button>
					</form>
				</td>
			</tr>
			@endforeach

		</tbody>
	</table>


	@endsection
	@section('assets')

	<script type="text/javascript">
		$('.delete-company').on('submit',function (e) {

			if(confirm('Are You Sure?') == true)
			{
				$('.delete-company').on('submit');
			}
			else{
				e.preventDefault();
			}
		})
	</script>

	@endsection