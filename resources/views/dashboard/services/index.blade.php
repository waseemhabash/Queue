@extends('dashboard.layouts.index')

@section('content')
<a href="{{ url('dashboard/services/create') }}">
	<button class="btn btn-success">
		<i class="fa fa-plus "></i>{{__("dashboard.addX",["X"=>__("dashboard.service")])}}
	</button>
</a>

<table class="table table-hover" id="sample-table-1">
	<thead>
		<tr>
			<th class="center">#</th>
			

			<th>{{__("dashboard.name")}}</th>
			
			
			<th>{{__("dashboard.description")}}</th>

			<th>{{ __("dashboard.options") }}</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($services as $service)
		<tr>
			<td class="center">{{$service->id}}</td>
			<td>{{$service->name}}</td>
			<td>{!!$service->description!!}</td>
			<td>
				<a href='{{ url("dashboard/services/$service->id/edit") }}' class="btn btn-xs btn-teal tooltips"
					data-placement="top" data-original-title="{{ __('dashboard.edit') }}"><i class="fa fa-edit"></i></a>
					<form class="delete-service" action='{{ url("/dashboard/services/$service->id") }}' method="POST" style="display:inline">
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
		$('.delete-service').on('submit',function (e) {

			if(confirm('Are You Sure?') == true)
			{
				$('.delete-service').on('submit');
			}
			else{
				e.preventDefault();
			}
		})
	</script>

	@endsection