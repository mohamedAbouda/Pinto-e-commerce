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
        <h3 class="section-title contacts-section-title">Reviews</h3>
    </div>
     <div class="col-xs-4 col-md-3">
        <div class="row">
            <div class="col-md-4 sort-col col-xs-4">
            </div>
            <div class="col-md-3 contact-edit-col col-xs-4">
            </div>
        </div>
    </div>
     <div class="col-md-4 col-md-offset-1 text-right col-xs-11">

        <div class="btn-group">
            <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-ellipsis-h"></i>
            </button>
            <ul class="dropdown-menu contact-dropdown pull-right" role="menu">
             
                <li>
                    <a href="{{route('dashboard.approved.reviews')}}">Approved Reviews</a>
                </li>
                  <li>
                    <a href="{{route('dashboard.disapproved.reviews')}}">Not Approved Deals</a>
                </li>
               
            </ul>
        </div>
    </div>
 
</div>
@stop

@section('content')
<div class="row">

    <div class="col-md-9">
        <div class="row">
            <div class="col-md-4 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">Total Count Reviews</h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">{{count($reviews)}}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $reviews->links() }}
        </div>
        <div class="margin-bottom10 contacts-list-view-card pad-bottom10 pad15">
            <table class="table table-borderless table-responsive">
                <tbody>
                    <tr>

                        <th>
                           Client
                        </th>
                        <th>
                           Product
                        </th>

                        <th>
                            Title
                        </th>

                         <th>
                            Action
                        </th>
                    </tr>
                    @foreach($reviews as $review)
                    <tr>
                        <td>
                            {{$review->client->name}}
                        </td>
                          <td>
                            {{$review->product->name}}
                        </td>

                         <td>
                            {{$review->name}}
                        </td>

                        <td>
                             <form method="post" action="{{route('dashboard.products.delete.review')}}" class="deleteReviewFrom" style="display: inline-block;">
                                    {{csrf_field()}}

                                <input type="hidden" name="review_id" value="{{$review->id}}">
                                 <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </button>
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
                        </td>
                        

                       
                         

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        @stop
@section('scripts')
<script type="text/javascript">
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