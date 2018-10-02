@if(Session::has('info'))
  <div class="col-md-12">
    <div class="alert alert-info alert-dismissible fade in">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
      </button>
      <strong>Info:</strong> {{ Session::get('info') }}
    </div>
  </div>
@endif