@extends('layouts.dashboard')

@section('title','Import Subscribers')

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{ route('dashboard.index' )}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li>
        <a href="{{ route('dashboard.subscribers.index') }}">Subscribers</a>
    </li>
    <li class="active">
        <strong>Import</strong>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">Import subscribers</h2>
        <div class="actions panel_actions pull-right"></div>
    </header>

    <div class="content-body">
        <div class="row">
            {{ Form::open(['route' => 'dashboard.subscribers.import' , 'files' => TRUE]) }}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h3>Cells of the CSV file must be like that:</h3>
                <div class="form-group">
                    <label class="form-label" for="file">e.g.</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <table class="table table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Name (optional)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>mina@restart-technology.com</td>
                                    <td>Mina Malak</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Download Example</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <a href="{{ url('assets/dashboard/example-csv/subscribers1.csv') }}" class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Download example of CSV file">
                            <i class="fa fa-download"></i>
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="file">CSV File</label>
                    <span class="desc"></span>
                    <div class="controls">
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</section>
@stop
