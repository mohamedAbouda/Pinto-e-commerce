@extends('layouts.dashboard.app')

@section('stylesheets')
<link rel="stylesheet" href="{{ asset('dashboard/plugins/select2.css') }}">
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">{{ trans('web.dashboard_sections_edit_create') }} </h3>
    </div>
    <div class="col-xs-12 col-md-3">
        <div class="row">
            <div class="col-md-4 sort-col col-xs-4">
            </div>
            <div class="col-md-3 contact-edit-col col-xs-4">
            </div>
        </div>
    </div>

</div>
@stop

@section('content')

<div class="row margin-top15">
    <div class="col-md-12">
         <div class="row">
             <form id="create-category" action="{{route('dashboard.sections.update',['id'=>$category->id])}}" method="post"
              enctype="multipart/form-data">

                                {{csrf_field()}}


                        <div class="col-md-12">
                            <h3 class="secondry-title">{{ trans('web.dashboard_sections_edit_info') }}.</h3> 
                        </div>
                        <div class="col-md-12">
                            <div class="form-group margin-bottom20"> 
                                <label class="control-label" for="formInput25">{{ trans('web.dashboard_sections_edit_name') }}</label>
                                <input type="text" class="form-control" id="formInput25" required name="name" value="{{$category->name}}">
                            </div>
                                              
                        </div>
                        <div class="col-md-12">
                       <div class="col-md-6">
                        
                            <div class="form-group margin-bottom20"> 
                                <label class="control-label" for="formInput25">{{ trans('web.dashboard_sections_edit_image') }}</label>
                                <input type="file" name="image" id="banner" class="form-control">
                            </div>                             
                        </div>
                         <img src="{{ url('storage/app/'.$category->image) }}" alt="" class="thumbnail" style="width:241px;height:165px;">
                     </div>
                          <div class="col-md-12">
                          
                                                      
                        </div>
                           <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_sections_edit_save') }}</button>
                    </div>
                </div>
            </form>

                    {{--     <div class="col-md-3">
                            <div class="form-group margin-bottom20"> 
                                <label class="control-label" for="formInput25">{{ trans('web.dashboard_sections_edit_picture') }}</label>
                                <input type="file" class="form-control input-file-mod hidden" required>
                                <img src="{{asset('assets/panel-assets/images/fields/01_picture.png')}}" class="img-responsive input-file-custom" onclick="$('.input-file-mod').click();" />
                            </div>                             
                        </div> --}}
                    </div>
    </div>
</div>
@stop
@section('scripts')
    <script type="text/javascript" src="{{ asset('dashboard/plugins/select2.js') }}"></script>
    <script type="text/javascript">
    $(function(){
        $("#Icon li a").click(function(e){
            e.preventDefault();
            $(".Icon").text($(this).text());
            $('input[name=icon]').val($(this).text());
        });
    });
    </script>
@stop
