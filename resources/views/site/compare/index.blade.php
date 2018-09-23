@extends('layouts.site.app')
@section('stylesheets')
<!--  starrr review -->         

@endsection
@section('content')
<div class="container">
	<div class="row">
 <section class="shopping-cart">
        <!-- .shopping-cart -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Library</li>
                    </ol>
                </div>
                @if($products)
                <div class="col-md-12">
                    <h2>Compare</h2>
                    <div class="table-responsive">
                        <table class="table-bordered table-condensed text-center compare-table">
                            <tr>
                                <td style="background-color:#f8f8f8;">
                                    <p class="compare-main">
                                        Product</p>
                                </td>
                                @foreach($products as $product)
                                  <td class="text-center compare{{$product->id}}">
                                    <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}" style="max-width: 150px;max-height: 150px;">
                                    <br>{{$product->name}}
                                </td>
                                @endforeach
                             
                              
                                
                            </tr>
                            <tr data-pg-collapsed>
                                <td style="background-color:#f8f8f8;">
                                    <p class="compare-main">Price </p>
                                </td>
                                @foreach($products as $product)
                                <td class="compare{{$product->id}}">
                                    <strong>{{$product->price}} EGP</strong>
                                </td>
                                @endforeach
                              
                            </tr>
                            <tr data-pg-collapsed>
                                <td style="background-color:#f8f8f8;">
                                    <p class="compare-main" > Description </p>
                                </td>
                               @foreach($products as $product)
                                <td class="compare{{$product->id}}">
                                    <strong>{{$product->short_description}} EGP</strong>
                                </td>
                                @endforeach
                              
                            </tr>
                            <tr data-pg-collapsed>
                                <td style="background-color:#f8f8f8;">
                                    <p class="compare-main">Color</p>
                                </td>
                                @foreach($products as $product)
                               
                                  <td class="compare{{$product->id}}">
                                    <strong>
                                         @foreach($product->stocks->groupBy('color') as $value)
                                        @foreach($value as $color) <br>
                                    {{$color->color}}
                                    @endforeach
                                        @endforeach
                                </strong>
                                </td>
                                
                                @endforeach
                              
                            
                           
                            </tr>
                            <tr data-pg-collapsed>
                                <td style="background-color:#f8f8f8;">
                                    <p class="compare-main">Avaliablity</p>
                                </td>
                               
                                @foreach($products as $product)
                                @if($product->stocks->sum('amount') - $product->orderProducts->sum('amount') > 0)
                                <td class="compare{{$product->id}}">
                                    <strong>In Stock</strong>
                                </td>
                                @else
                                <td class="compare{{$product->id}}">
                                    <strong>Not In Stock</strong>
                                </td>
                                @endif
                                @endforeach
                            </tr>
                            <tr data-pg-collapsed>
                                <td style="background-color:#f8f8f8;">
                                    <p class="compare-main">Delete</p>
                                </td>
                                @foreach($products as $product)
                                <td class="compare{{$product->id}}">
                                    <span class="red" onclick="deleteCompare({{$product->id}})">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </span>
                                </td>
                                @endforeach
                              
                            </tr>
                        </table>
                    </div>
                </div>
                @else
                No Products To Compare
                @endif
            </div>
        </div>
        <!-- /.shopping-cart -->
    </section>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	

	function deleteCompare(id) {
    var id = id;

       $.ajax({
    type: "POST",

    url: "{{route('web.delete.compare.product')}}",
    data: {
         _token: "{{ csrf_token() }}",
        id: id
    },
    success: function(data) {
       $('.compare'+id).remove();
    }
});
}


</script>
@endsection