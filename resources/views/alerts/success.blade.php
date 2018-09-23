@if(Session::has('success'))
  <div class="col-md-12">
    <div class="alert alert-success alert-dismissible fade in">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Success:</strong> {{ Session::get('success') }}
    </div>
  </div>
@endif