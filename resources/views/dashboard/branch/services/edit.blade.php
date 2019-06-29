@extends('dashboard.layouts.index')

@section('content')
<form action="{{ url('dashboard/services/'.$service->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    @method('PATCH')


    {{ bs_input("name",$service->name,true) }}
    {{ bs_text("description",$service->description,true) }}

    {{ bs_number("timeInMinutes",$service->time,true) }}



    @if (round($service->avg_time()) != $service->time)
    <div class="form-group">
        <label class="col-sm-1 control-label" style="text-align:right">  </label>
        <div class="col-sm-6">
            <p style="color:grey;font-size:14px">
                تظهر البيانات و سلوك الموظفين أن الخدمة تأخذ : <span style="color:chocolate;font-weight: bold"> {{ round($service->avg_time()) }} دقيقة </span>
            </p>
        </div>
    </div>
    @endif

   


    {{ bs_tag("requirements",$service->requirements,true) }}


    {{ bs_multiple_files("images",null,false,"image/*") }}

    
    <div class="form-group">
            <label class="col-sm-1 control-label" for="" style="text-align:right">
            </label>
            <div class="col-sm-6">
                <div class="row">
                        @foreach ($service->images as $image)
                        <div class="col-md-3 col-sm-4 gallery-img">
                             <div class="wrap-image">
                                 <a class="group1" href="#" title="Clip-One Responsive Screen">
                                     <img src="{{ url($image->path) }}" alt="" class="img-responsive" style="height:100px">
                                 </a>
                                 <div class="tools tools-bottom">
                                     
                                 <a href="{{ url('dashboard/delete_service_image/'.$image->id) }}">
                                         <i class="clip-close-2"></i>
                                     </a>
                                 </div>
                             </div>
                         </div>
                        @endforeach
                </div>
            </div>
        </div>

           
           
            


    {{ bs_save("save") }}


</form>
@endsection

