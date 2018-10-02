@extends('layouts.site.app')

@section('content')
<div class="hero-section v3">
    <img src="{{ asset('assets/site/img/about/about_simple_bg.jpg') }}" alt="" class="img-responsive">
    <div class="box-center">
        <h1 class="page-title">Contact</h1>
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}">Home</a></li>
            <li><a href="{{ route('web.contact') }}">Contact Us</a></li>
        </ul>
    </div>
</div>
<div class="container">
    <div class="contact about_simple">
        <div class="row">
            <?php if ($contact->store_location_title_1): ?>
                <div class="col-xs-12 col-sm-4">
                    <h2 class="about-title">{{ $contact->store_location_title_1 ? $contact->store_location_title_1 : 'Pinto Store NY' }}</h2>
                    <?php if ($contact->store_location_address_1): ?>
                        <p class="address">{{ $contact->store_location_address_1 }}</p>
                    <?php endif; ?>
                    <?php if ($contact->store_location_hours_1): ?>
                        <p>Store Hours</p>
                        <p class="hours">{{ $contact->store_location_hours_1 }}</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($contact->store_location_title_2): ?>
                <div class="col-xs-12 col-sm-4">
                    <h2 class="about-title">{{ $contact->store_location_title_2 ? $contact->store_location_title_2 : 'Pinto Store UK' }}</h2>
                    <?php if ($contact->store_location_address_2): ?>
                        <p class="address">{{ $contact->store_location_address_2 }}</p>
                    <?php endif; ?>
                    <?php if ($contact->store_location_hours_2): ?>
                        <p>Store Hours</p>
                        <p class="hours">{{ $contact->store_location_hours_2 }}</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($contact->store_location_title_3): ?>
                <div class="col-xs-12 col-sm-4">
                    <h2 class="about-title">{{ $contact->store_location_title_3 ? $contact->store_location_title_3 : 'Pinto Store EG' }}</h2>
                    <?php if ($contact->store_location_address_3): ?>
                        <p class="address">{{ $contact->store_location_address_3 }}</p>
                    <?php endif; ?>
                    <?php if ($contact->store_location_hours_3): ?>
                        <p>Store Hours</p>
                        <p class="hours">{{ $contact->store_location_hours_3 }}</p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        {{ Form::open(['class' => 'comment-form contact-form' ,'route' => 'web.contact']) }}
        <div class="form-group">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <label>Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                </div>
                <div class="col-md-6 col-xs-12">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                </div>

            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <label>Subject *</label>
                    <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" required>
                    <p class="text-danger">{{ $errors->first('subject') }}</p>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-12">
                    <label>Message *</label>
                    <textarea name="comment" tabindex="2" class="form-control" required>{{ old('comment') }}</textarea>
                    <p class="text-danger">{{ $errors->first('comment') }}</p>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-submit ver2">Send</button>
        {{ Form::close() }}
    </div>
</div>
@stop
