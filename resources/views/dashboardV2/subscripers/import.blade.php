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
            Subscribers
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
            <div class="col-md-12">
                <h3 class="secondry-title">Example</h3>
                <table class="table table-bordered table-responsive" style="margin-bottom:0;">
                    <thead>
                        <tr>
                            <th class="text-center">Email</th>
                            <th class="text-center">Name (optional)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">mina@restart-technology.com</td>
                            <td class="text-center">Mina Malak</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12">
                {{ Form::open(['route' => 'dashboard.subscribers.import' , 'files' => TRUE]) }}
                <div class="form-group">
                    <h3 class="secondry-title">Download Example</h3>
                    <div class="controls">
                        <a href="{{ url('assets/dashboard/example-csv/subscribers1.csv') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Download example of CSV file">
                            <i class="fa fa-download"></i>
                        </a>
                    </div>
                    <h3 class="secondry-title">Upload CSV File</h3>
                    <label for="file" class="btn btn-blue">
                        <span>Upload csv file</span>
                        <input type="file" name="file" class="form-control" id="file" style="display:none;">
                    </label>
                    <div class="text-left pull-right">
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop
@section('scripts')
<script>

</script>
@stop
