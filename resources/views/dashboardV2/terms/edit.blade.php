@extends('layouts.dashboard.app')
@section('title','')
@section('description','')
@section('content')
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row">
            <form action="{{route('dashboard.terms.update', ['term' => $term->id]) }}" method="post"  enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea name="body" class="form-control">{{ $term->description }}</textarea>
                    </div>
                    <div class="form-group margin-bottom20">
                        <label class="control-label">Questions</label>
                        <table class="table faq-table">
                            <thead>
                                <tr>
                                    <th class="text-center"> # </th>
                                    <th></th>
                                    <th>
                                        <button type="button" class="btn btn-sm btn-default pull-right add-faq" style="max-width: 130px;width:100%;height:100%;margin-bottom:0;">Add more</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="tr-template" style="display:none">
                                    <td class="text-center" data-index="undefined"> undefined </td>
                                    <td>
                                        {{ Form::text('question[undefined]' ,NULL ,['class' => 'form-control margin-bottom10']) }}
                                        {{ Form::textarea('answer[undefined]' ,NULL ,['class' => 'form-control']) }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger pull-right delete-faq" style="max-width: 130px;width:100%;height:100%;margin-bottom:0;" onclick="deleteFAQ(this)">Delete</button>
                                    </td>
                                </tr>
                                @foreach($terms_faq as $faq)
                                <tr>
                                    <td class="text-center" data-index="{{ $loop->iteration - 1 }}"> {{ $loop->iteration - 1 }} </td>
                                    <td>
                                        {{ Form::text('faq[' . ($loop->iteration - 1) . '][question]' ,$faq->question ,['class' => 'form-control margin-bottom10']) }}
                                        {{ Form::textarea('faq[' . ($loop->iteration - 1) . '][answer]' ,$faq->answer ,['class' => 'form-control']) }}
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger pull-right delete-faq" style="max-width: 130px;width:100%;height:100%;margin-bottom:0;" onclick="deleteFAQ(this)">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">{{ trans('web.dashboard_terms_create_save') }}</button>
                        <button type="reset" onclick="window.location=window.location" class="btn btn-danger">{{ trans('web.dashboard_terms_create_reset') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('scripts')
<!-- <script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script> -->
<script type="text/javascript">
// CKEDITOR.replace('body');
var tr_counter = {{ $terms_faq->count() }};
function deleteFAQ(el){
    $(el).parents('tr').remove();
    tr_counter = 0;
    $('.faq-table tbody tr').each(function(index) {
        if (index === 0) {
            return;
        }
        $(this).find('td:eq(0)').attr('data-index' ,tr_counter).text(tr_counter);
        $(this).find('input[type=text]').attr('name' ,'faq[' + tr_counter + '][question]');
        $(this).find('textarea').attr('name' ,'faq[' + tr_counter + '][answer]');
        tr_counter++;
    });
}

$(document).ready(function() {
    $('.faq-table').find('.add-faq').click(function(){
        $('.tr-template').find('td:eq(0)').attr('data-index' ,tr_counter).text(tr_counter);
        $('.tr-template').find('input[type=text]').attr('name' ,'faq[' + tr_counter + '][question]');
        $('.tr-template').find('textarea').attr('name' ,'faq[' + tr_counter + '][answer]');
        tr_counter++;
        $('.faq-table tbody').append('<tr>' + $('.tr-template').html() + '</tr>');

        $('.tr-template').find('td:eq(0)').attr('data-index' ,0).text(0);
        $('.tr-template').find('input[type=text]').attr('name' ,'');
        $('.tr-template').find('textarea').attr('name' ,'');
    });
    // $('.delete-faq').click(function(){
    //     deleteFAQ(this);
    // });
});
</script>
@stop
