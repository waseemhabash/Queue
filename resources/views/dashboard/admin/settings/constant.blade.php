@extends('dashboard.layouts.index')

@section('content')


<form role="form" class="form-horizontal" action="{{ url('dashboard/constants/update') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method("POST")

    @foreach ($constants as $constant)
        
        @if ($constant->type == "image")
            

        {{ bs_image($constant->indexx,$constant->value) }}


        @elseif($constant->type == "string")
            
        {{ bs_input($constant->indexx,$constant->value) }}

        @elseif($constant->type == "text")

        {{ bs_text($constant->indexx,$constant->value) }}

        @endif

    @endforeach

    {{ bs_save("save") }}
</form>


@endsection
