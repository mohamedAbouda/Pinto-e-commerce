 @extends('layouts.dashboard.app')
@section('title','')
@section('description','')
@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="{{route('dashboard.about.update', ['about' => $about->id]) }}" method="post"  enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
               <div class="col-md-12">
                    <div class="form-group">
                        
                        <textarea name="body">{{$about->description}}</textarea>
                    </div>
                </div>
                 


               
           
              

        


      
                <div class="col-md-12">
                    <div class="form-group">
                        <button class="btn btn-primary">save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="//cdn.ckeditor.com/4.7.0/full/ckeditor.js"></script>
<script type="text/javascript">
     CKEDITOR.replace('body');
</script>
@endsection