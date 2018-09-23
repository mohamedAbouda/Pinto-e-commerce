
@extends('layouts.dashboard.app')

@section('stylesheets')
<style>
body {
    background-color:#edeff9;
}
</style>
@stop

@section('section-title')
<div class="row">
    <div class="col-md-4 col-xs-12">
        <h3 class="section-title contacts-section-title">
            {{ trans('web.dashboard_products_reviews_data') }}.
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
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="">
                <tbody id="bodyTable">
                   <tr>
                       <td>
                         <span style="margin-left:30px;">
                         <strong>  {{ trans('web.dashboard_products_reviews_count') }}</strong>
                       </span>
                       </td>
                       <td>
                           {{count($reviews)}}
                       </td>
                   </tr>

                     <tr>
                       <td>
                         <span style="margin-left:30px;">
                         <strong> {{ trans('web.dashboard_products_reviews_avg') }}</strong>
                       </span>
                       </td>
                       <td>
                           {{number_format($avg, 2, '.', ',')}}
                       </td>
                   </tr>


                      <tr>
                        <td class="">
                            <span style="margin-left:30px;">
                                {{ trans('web.dashboard_products_reviews_rev') }}
                            </span>
                        </td>
                        <td>
                            @foreach($reviews as $review)
                            <div id="review{{$review->id}}">
                            <strong>{{ trans('web.dashboard_products_reviews_name') }} :</strong><a href="{{url('dashboard/users/'.$review->client->id)}}">{{$review->client->name}}</a><br>
                            <strong>{{ trans('web.dashboard_products_reviews_title') }} :</strong>{{$review->name}}<br>
                            <strong>{{ trans('web.dashboard_products_reviews_rate') }} :</strong>{{$review->rate}}<br>
                            <strong>{{ trans('web.dashboard_products_reviews_review') }} :</strong>{{$review->review}}
                            <br>
                            <form method="post" action="{{route('dashboard.products.delete.review')}}" class="deleteReviewFrom" style="display: inline-block;">
                                    {{csrf_field()}}

                                <input type="hidden" name="review_id" value="{{$review->id}}">
                                 <button type="submit" class="btn btn-danger btn-sm" disabled><i class="fa fa-trash"></i> </button>
                            </form>
                            @if($review->approved == 0)
                              <form method="post" action="{{route('dashboard.review.toggle.status')}}" style="display: inline-block;">
                                    {{csrf_field()}}

                                <input type="hidden" name="review_id" value="{{$review->id}}">
                                 <button type="submit" class="btn btn-primary btn-sm">Approve </button>
                            </form>
                            @else
                              <form method="post" action="{{route('dashboard.review.toggle.status')}}" style="display: inline-block;">
                                    {{csrf_field()}}

                                <input type="hidden" name="review_id" value="{{$review->id}}">
                                 <button type="submit" class="btn btn-danger btn-sm">Disapprove </button>
                            </form>
                            @endif
                            <button class="btn btn-success btn-sm" onclick="showReviewForm({{$review->id}})">Edit</button>
                              <form method="post" class="review-form{{$review->id}}" style="display: none;" action="{{route('dashboard.review.update')}}">
                                    {{csrf_field()}}

                                <input class="form-control" type="hidden" name="review_id" value="{{$review->id}}">
                                <input type="text" name="name" value="{{$review->name}}">
                                <input class="form-control" type="number" min="1" name="rate" value="{{$review->rate}}">
                                <textarea class="form-control" name="review">{{$review->review}}</textarea>
                                 <button type="submit" class="btn btn-primary btn-sm">Submit </button>
                            </form>
                            <hr>
                        </div>
                            @endforeach
                        </td>
                    </tr>




                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.deleteReviewFrom').find('button').attr('disabled' ,false);
    });
      $('#bodyTable').on('submit','.deleteReviewFrom',function (e){
    e.preventDefault();
        var form = jQuery(this);
        var dataString = form.serialize();
        var formAction = form.attr('action');
        $.ajax({
          type: "POST",
          url : formAction,
          data : dataString,
          success : function(data){
          $('#review'+data).remove();

          },
          error : function(data){

          }
        },"json");
  });

      function showReviewForm(id) {
        $('.review-form'+id).toggle();
      }
</script>
@stop
