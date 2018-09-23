@extends('layouts.dashboard.app')

@section('section-title')
<div class="row">
    <div class="col-md-4 col-sm-12">
        <h3 class="section-title">Add Contact</h3>
    </div>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Contact Info.</h3>
    </div>
    <div class="col-md-3">
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">First Name</label>
            <input type="text" class="form-control" id="formInput25" required>
        </div>
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Email Address</label>
            <input type="text" class="form-control" id="formInput25" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Second Name</label>
            <input type="text" class="form-control" id="formInput25" required>
        </div>
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Phone Number</label>
            <input type="text" class="form-control" id="formInput25" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Picture</label>
            <input type="file" class="form-control input-file-mod hidden" required>
            <img src="{{ asset('assets/panel-assets/images/fields/01_picture.png') }}" class="img-responsive input-file-custom" onclick="$('.input-file-mod').click();" />
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3 class="secondry-title">Other Info.</h3>
    </div>
    <div class="col-md-3">
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Title</label>
            <input type="text" class="form-control" id="formInput25" required>
        </div>
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">City</label>
            <select type="text" class="form-control" id="formInput25">
                <option value="value">Name</option>
                <option value="value">Name</option>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Company</label>
            <input type="text" class="form-control" id="formInput25" required>
        </div>
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Country</label>
            <select type="text" class="form-control" id="formInput25">
                <option value="value">Name</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group margin-bottom20">
            <label class="control-label" for="formInput25">Address</label>
            <input type="text" class="form-control" id="formInput25" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-1 col-xs-4">
        <button type="button" class="btn primary-btn">Save</button>
    </div>
    <div class="col-md-1 col-xs-4">
        <button type="button" class="btn cancel-btn">Cancel</button>
    </div>
</div>
@stop
