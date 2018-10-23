@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            {{ trans('web.dashboard_sections_pages_create_page_section_title_edit_section') }}
        </h3>
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
            <form id="create-category" action="{{route('dashboard.categories.update',['id'=>$category->id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="col-md-12">
                    <h3 class="secondry-title">{{ trans('web.dashboard_sections_pages_create_page_section_info') }}.</h3>
                </div>
                <div class="col-md-12">
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="formInput25">
                            <span class="text-danger">*</span>
                            {{ trans('web.dashboard_sections_pages_create_page_form_title_section_name') }}
                        </label>
                        <input type="text" class="form-control" id="formInput25" required name="name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group margin-bottom20">
                        <label class="control-label" for="icon">
                            <span class="text-danger">*</span>
                            Icon
                        </label>
                        {{ Form::text('icon',old('icon'),['id'=>'icon','required'=>'required','class' => 'form-control icon']) }}
                        <p class="text-danger" style="margin-bottom: 0;">{{ $errors->first('icon') }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- <div class="form-group margin-bottom20">
                    <label class="control-label" for="formInput25">Section Image</label>
                    <input type="file" class="form-control" id="formInput25"  name="image">
                    ** the image will resize automatically
                </div> -->
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="formInput25">{{ trans('web.dashboard_sections_pages_create_page_form_title_add_to_navbar') }}</label><br>
                    <input type="radio" name="navBar" value="1" {{ $category->navBar ? 'checked' : '' }}> Yes<br>
                    <input type="radio" name="navBar" value="0" {{ !$category->navBar ? 'checked' : '' }}> No<br>
                </div>
                <div class="form-group margin-bottom20">
                    <label class="control-label">{{ trans('web.dashboard_sections_pages_create_page_form_title_options') }}</label><br>
                    <input type="checkbox" name="has_size" value="1" {{ $category->has_size ? 'checked' : '' }}> {{ trans('web.dashboard_sections_pages_create_page_form_has_size') }}<br>
                    <input type="checkbox" name="has_color" value="1" {{ $category->has_color ? 'checked' : '' }}> {{ trans('web.dashboard_sections_pages_create_page_form_has_color') }}<br>
                    <input type="checkbox" name="has_brand" value="1" {{ $category->has_brand ? 'checked' : '' }}> {{ trans('web.dashboard_sections_pages_create_page_form_has_brand') }}<br>
                </div>
            </div>
                             <input type="hidden" name="unicode" class="unicode">

            <div class="col-md-12">
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="payment_withhold">{{ trans('web.dashboard_sections_pages_create_page_form_payment_withhold') }}</label>
                    <input type="number" min="0" step="0.25" value="{{ $category->payment_withhold }}" class="form-control" id="payment_withhold" name="payment_withhold" required>
                </div>
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="payment_due_percentage">{{ trans('web.dashboard_sections_pages_create_page_form_payment_percentage') }}</label>
                    <input type="number" min="0" step="0.25" value="{{ $category->payment_due_percentage }}" class="form-control" id="payment_due_percentage" name="payment_due_percentage" required>
                </div>
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="shipping_cost">{{ trans('web.dashboard_sections_pages_create_page_form_shipping_costs') }}</label>
                    <input type="number" min="0" step="0.25" value="{{ $category->shipping_cost }}" class="form-control" id="shipping_cost" name="shipping_cost" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group margin-bottom20">
                    <label class="control-label" for="formInput25">
                        Key Word
                    </label>
                    <textarea class="form-control" name="text">{{$category->keyWord ? $category->keyWord->text : ''}}</textarea>
                    ** please sperate by ,
                </div>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" id="submitButton" class="btn btn-primary">
                        {{ trans('web.dashboard_create_page_save_button') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@stop

@section('stylesheets')
{{ Html::style('assets/panel-assets/plugins/fontawesome-iconpicker/dist/css/fontawesome-iconpicker.min.css') }}
@stop

@section('scripts')
{{ Html::script('assets/panel-assets/plugins/fontawesome-iconpicker/dist/js/fontawesome-iconpicker.min.js') }}
<script type="text/javascript">
$('#icon').iconpicker();
$('#submitButton').click(function(e){
    e.preventDefault();
    var icon =  document.getElementsByClassName("icon")[0].value;
    console.log(icon);
    $('.unicode').val(faUnicode(icon));
    $('#create-category').submit();
   
});

function faUnicode(name) {
  var testI = document.createElement('i');
  var char;

  testI.className = name;
  document.body.appendChild(testI);

  char = window.getComputedStyle( testI, ':before' )
           .content.replace(/'|"/g, '');

  testI.remove();

  return "\\u" + char.charCodeAt(0).toString(16);
}
</script>
@stop
