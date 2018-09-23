@extends('layouts.dashboard')

@section('title','Settings')

@section('stylesheets')
    {{ Html::style('assets/dashboard/plugins/awesome-bootstrap-checkbox-master/awesome-bootstrap-checkbox.css') }}
@stop

@section('scripts')
<script type="text/javascript">
    function preview(fileInput)
    {
        document.getElementById('logo-text').innerHTML = document.getElementById('logo').value;

        var preview = document.getElementById('logo-preview');
        var file    = fileInput.files[0];
        var reader  = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@stop

@section('path')
<ol class="breadcrumb">
    <li>
        <a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i>Home</a>
    </li>
    <li class="active">
        <a href="{{route('dashboard.collection.index')}}">Settings</a>
    </li>
</ol>
@stop

@section('content')
<section class="box ">

    <header class="panel_header">
        <h2 class="title pull-left">
            Settings
        </h2>
    </header>

    <div class="content-body">
        <div class="row">
            {{ Form::open(['route'=>'dashboard.setting.update' , 'files' => TRUE]) }}
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#s1" aria-controls="s1" role="tab" data-toggle="tab">
                        Settings 1 (general)
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#s2" aria-controls="s2" role="tab" data-toggle="tab">
                        Settings 2 (social media)
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#s3" aria-controls="s3" role="tab" data-toggle="tab">
                        Theme options
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="s1">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="site_name">
                                    Site name
                                </label>
                                <div class="controls">
                                    <input type="text" name="site_name" id="site_name" class="form-control" value="{{ $settings?$settings->site_name:old('site_name') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('site_name') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="currency">
                                    Currency
                                </label>
                                <div class="controls">
                                    <input type="text" value="{{ $settings?$settings->currency:'' }}" class="form-control" disabled>
                                    <p></p>
                                    <select name="currency" class="form-control">
                                        <option value="">Select the currency</option>
                                        <option value="USD">United States Dollars</option>
                                        <option value="EUR">Euro</option>
                                        <option value="GBP">United Kingdom Pounds</option>
                                        <option value="DZD">Algeria Dinars</option>
                                        <option value="ARP">Argentina Pesos</option>
                                        <option value="AUD">Australia Dollars</option>
                                        <option value="ATS">Austria Schillings</option>
                                        <option value="BSD">Bahamas Dollars</option>
                                        <option value="BBD">Barbados Dollars</option>
                                        <option value="BEF">Belgium Francs</option>
                                        <option value="BMD">Bermuda Dollars</option>
                                        <option value="BRR">Brazil Real</option>
                                        <option value="BGL">Bulgaria Lev</option>
                                        <option value="CAD">Canada Dollars</option>
                                        <option value="CLP">Chile Pesos</option>
                                        <option value="CNY">China Yuan Renmimbi</option>
                                        <option value="CYP">Cyprus Pounds</option>
                                        <option value="CSK">Czech Republic Koruna</option>
                                        <option value="DKK">Denmark Kroner</option>
                                        <option value="NLG">Dutch Guilders</option>
                                        <option value="XCD">Eastern Caribbean Dollars</option>
                                        <option value="EGP">Egypt Pounds</option>
                                        <option value="FJD">Fiji Dollars</option>
                                        <option value="FIM">Finland Markka</option>
                                        <option value="FRF">France Francs</option>
                                        <option value="DEM">Germany Deutsche Marks</option>
                                        <option value="XAU">Gold Ounces</option>
                                        <option value="GRD">Greece Drachmas</option>
                                        <option value="HKD">Hong Kong Dollars</option>
                                        <option value="HUF">Hungary Forint</option>
                                        <option value="ISK">Iceland Krona</option>
                                        <option value="INR">India Rupees</option>
                                        <option value="IDR">Indonesia Rupiah</option>
                                        <option value="IEP">Ireland Punt</option>
                                        <option value="ILS">Israel New Shekels</option>
                                        <option value="ITL">Italy Lira</option>
                                        <option value="JMD">Jamaica Dollars</option>
                                        <option value="JPY">Japan Yen</option>
                                        <option value="JOD">Jordan Dinar</option>
                                        <option value="KRW">Korea (South) Won</option>
                                        <option value="LBP">Lebanon Pounds</option>
                                        <option value="LUF">Luxembourg Francs</option>
                                        <option value="MYR">Malaysia Ringgit</option>
                                        <option value="MXP">Mexico Pesos</option>
                                        <option value="NLG">Netherlands Guilders</option>
                                        <option value="NZD">New Zealand Dollars</option>
                                        <option value="NOK">Norway Kroner</option>
                                        <option value="PKR">Pakistan Rupees</option>
                                        <option value="XPD">Palladium Ounces</option>
                                        <option value="PHP">Philippines Pesos</option>
                                        <option value="XPT">Platinum Ounces</option>
                                        <option value="PLZ">Poland Zloty</option>
                                        <option value="PTE">Portugal Escudo</option>
                                        <option value="ROL">Romania Leu</option>
                                        <option value="RUR">Russia Rubles</option>
                                        <option value="SAR">Saudi Arabia Riyal</option>
                                        <option value="XAG">Silver Ounces</option>
                                        <option value="SGD">Singapore Dollars</option>
                                        <option value="SKK">Slovakia Koruna</option>
                                        <option value="ZAR">South Africa Rand</option>
                                        <option value="KRW">South Korea Won</option>
                                        <option value="ESP">Spain Pesetas</option>
                                        <option value="XDR">Special Drawing Right (IMF)</option>
                                        <option value="SDD">Sudan Dinar</option>
                                        <option value="SEK">Sweden Krona</option>
                                        <option value="CHF">Switzerland Francs</option>
                                        <option value="TWD">Taiwan Dollars</option>
                                        <option value="THB">Thailand Baht</option>
                                        <option value="TTD">Trinidad and Tobago Dollars</option>
                                        <option value="TRL">Turkey Lira</option>
                                        <option value="VEB">Venezuela Bolivar</option>
                                        <option value="ZMK">Zambia Kwacha</option>
                                        <option value="EUR">Euro</option>
                                        <option value="XCD">Eastern Caribbean Dollars</option>
                                        <option value="XDR">Special Drawing Right (IMF)</option>
                                        <option value="XAG">Silver Ounces</option>
                                        <option value="XAU">Gold Ounces</option>
                                        <option value="XPD">Palladium Ounces</option>
                                        <option value="XPT">Platinum Ounces</option>
                                    </select>
                                </div>
                                <p class="text-danger">{{ $errors->first('currency') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="hotline">
                                    Hotline number
                                </label>
                                <div class="controls">
                                    <input type="text" name="hotline" id="hotline" class="form-control" value="{{ $settings?$settings->hotline:old('hotline') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('hotline') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="logo">Logo image</label>
                                <img style="max-height: 200px;max-width: 200px;margin-bottom:0px !important;" class="thumbnail" id="logo-preview"
                                src="{{ $settings && $settings->logo ? url('storage/app/'.$settings->logo) : '' }}" alt="No image uploaded">
                                <div class="controls">
                                    <label for="logo" class="btn btn-primary">
                                        Upload logo image
                                        <input type="file" name="logo" id="logo" class="form-control hidden" onchange="preview(this);">
                                    </label>
                                    <span id="logo-text" class="text-primary">
                                    </span>
                                </div>
                                <p class="text-danger">{{ $errors->first('logo') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">
                                    Description
                                </label>
                                <div class="controls">
                                    <textarea name="description" id="description" class="form-control" rows='10' style="width:100%;">{{ $settings?$settings->description:old('description') }}</textarea>
                                </div>
                                <p class="text-danger">{{ $errors->first('description') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="facebook_pixel_base_code">
                                    Facebook pixel base code
                                </label>
                                <div class="controls">
                                    <textarea name="facebook_pixel_base_code" id="facebook_pixel_base_code" class="form-control" rows='10' style="width:100%;">{{ $settings?$settings->facebook_pixel_base_code:old('facebook_pixel_base_code') }}</textarea>
                                </div>
                                <p class="text-danger">{{ $errors->first('facebook_pixel_base_code') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="facebook_pixel_event_code">
                                    Facebook pixel event code
                                </label>
                                <div class="controls">
                                    <textarea name="facebook_pixel_event_code" id="facebook_pixel_event_code" class="form-control" rows='10' style="width:100%;">{{ $settings?$settings->facebook_pixel_event_code:old('facebook_pixel_event_code') }}</textarea>
                                </div>
                                <p class="text-danger">{{ $errors->first('facebook_pixel_event_code') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="google_analytics">
                                    Google analytics code
                                </label>
                                <div class="controls">
                                    <textarea name="google_analytics" id="google_analytics" class="form-control" rows='10' style="width:100%;">{{ $settings?$settings->google_analytics:old('google_analytics') }}</textarea>
                                </div>
                                <p class="text-danger">{{ $errors->first('google_analytics') }}</p>
                            </div>

                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="s2">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="fb_link">
                                    Facebook link
                                </label>
                                <div class="controls">
                                    <input type="text" name="fb_link" id="fb_link" class="form-control" value="{{ $settings?$settings->fb_link:old('fb_link') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('fb_link') }}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="tw_link">
                                    Twitter link
                                </label>
                                <div class="controls">
                                    <input type="text" name="tw_link" id="tw_link" class="form-control" value="{{ $settings?$settings->tw_link:old('tw_link') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('tw_link') }}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="gp_link">
                                    Google+ link
                                </label>
                                <div class="controls">
                                    <input type="text" name="gp_link" id="gp_link" class="form-control" value="{{ $settings?$settings->gp_link:old('gp_link') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('gp_link') }}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pin_link">
                                    Pinterest link
                                </label>
                                <div class="controls">
                                    <input type="text" name="pin_link" id="pin_link" class="form-control" value="{{ $settings?$settings->pin_link:old('pin_link') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('pin_link') }}</p>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="tu_link">
                                    Tumblr link
                                </label>
                                <div class="controls">
                                    <input type="text" name="tu_link" id="tu_link" class="form-control" value="{{ $settings?$settings->tu_link:old('tu_link') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('tu_link') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="s3">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="form-label" for="theme_color">
                                    Theme color
                                </label>
                                <div class="controls">
                                    <div class="radio">
                                        <input type="radio" name="theme" id="theme_color_radio_1" value="theme-blue" {{ $settings->theme === 'theme-blue' ? 'checked' : '' }}>
                                        <label for="theme_color_radio_1" class="">
                                            <span class="pull-left">
                                                Blue
                                            </span>
                                            <span class="thumbnail pull-left" style="width:40px;margin-left:4px;margin-bottom:0px;">
                                                <div style="height:15px;width:30px;background-color:#5f87d1;">
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="radio">
                                        <input type="radio" name="theme" id="theme_color_radio_2" value="theme-cyan" {{ !$settings->theme || $settings->theme === 'theme-cyan' ? 'checked' : '' }}>
                                        <label for="theme_color_radio_2">
                                            <span class="pull-left">
                                                Cyan
                                            </span>
                                            <span class="thumbnail pull-left" style="width:40px;margin-left:4px;margin-bottom:0px;">
                                                <div style="height:15px;width:30px;background-color:#009688;">
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="radio">
                                        <input type="radio" name="theme" id="theme_color_radio_3" value="theme-green" {{ $settings->theme === 'theme-green' ? 'checked' : '' }}>
                                        <label for="theme_color_radio_3">
                                            <span class="pull-left">
                                                Green
                                            </span>
                                            <span class="thumbnail pull-left" style="width:40px;margin-left:4px;margin-bottom:0px;">
                                                <div style="height:15px;width:30px;background-color:#20bc5a;">
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="radio">
                                        <input type="radio" name="theme" id="theme_color_radio_3" value="theme-orange" {{ $settings->theme === 'theme-orange' ? 'checked' : '' }}>
                                        <label for="theme_color_radio_3">
                                            <span class="pull-left">
                                                Orange
                                            </span>
                                            <span class="thumbnail pull-left" style="width:40px;margin-left:4px;margin-bottom:0px;">
                                                <div style="height:15px;width:30px;background-color:#F4A137;">
                                                </div>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <p class="text-danger">{{ $errors->first('theme') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="footer_text_under_logo">
                                    Site description in footer just under the logo :
                                </label>
                                <div class="controls">
                                    <textarea name="footer_text_under_logo" id="footer_text_under_logo" class="form-control" rows='10' style="width:100%;">{{ $settings?$settings->footer_text_under_logo:old('footer_text_under_logo') }}</textarea>
                                </div>
                                <p class="text-danger">{{ $errors->first('footer_text_under_logo') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="footer_address">
                                    Footer address :
                                </label>
                                <div class="controls">
                                    <input type="text" name="footer_address" id="footer_address" class="form-control" value="{{ $settings?$settings->footer_address:old('footer_address') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('footer_address') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="footer_email">
                                    Footer email :
                                </label>
                                <div class="controls">
                                    <input type="email" name="footer_email" id="footer_email" class="form-control" value="{{ $settings?$settings->footer_email:old('footer_email') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('footer_email') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="footer_phone">
                                    Footer phone :
                                </label>
                                <div class="controls">
                                    <input type="text" name="footer_phone" id="footer_phone" class="form-control" value="{{ $settings?$settings->footer_phone:old('footer_phone') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('footer_phone') }}</p>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="footer_rights">
                                    Footer rights :
                                </label>
                                <div class="controls">
                                    <input type="text" name="footer_rights" id="footer_rights" class="form-control" value="{{ $settings?$settings->footer_rights:old('footer_rights') }}">
                                </div>
                                <p class="text-danger">{{ $errors->first('footer_rights') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12 padding-bottom-30">
                <div class="text-left">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="reset" class="btn">Reset</button>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>
</section>
@stop
