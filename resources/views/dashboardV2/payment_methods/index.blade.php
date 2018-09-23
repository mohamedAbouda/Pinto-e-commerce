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
            {{ trans('web.dashboard_payment_methods_pages_index_page_section_header_payment_methods') }}
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
    <!-- <div class="col-md-4 col-md-offset-1 text-right col-xs-11">
        <a class="btn btn-blue margin-left-10">
            <span>+ </span>Add payment method
        </a>
    </div> -->
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-5 margin-bottom10 margin-top20">
                <div class="total-customer-col pad5 pad-bottom5 col-md-12">
                    <div class="col-md-9 customer-stat-col-pad">
                        <h5 class="customer-stat-text pad5">
                            {{ trans('web.dashboard_payment_methods_pages_index_page_total_payment_methods_count') }}
                        </h5>
                    </div>
                    <div class="col-md-3 text-center">
                        <h5 class="customer-stat-num pad5">
                            {{ $total_resources_count }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row margin-top15">
    <div class="col-md-12">
        <div class="row margin-bottom10">
            {{ $resources->links() }}
        </div>
        <div class="row margin-bottom10 contacts-list-view-card pad15">
            <table class="table table-borderless table-responsive" style="margin-bottom:0;">
                <tbody>
                    <tr>
                        <th class="text-center">#</th>
                        <th>
                            {{ trans('web.dashboard_payment_methods_pages_index_page_table_header_payment_method') }}
                        </th>
                        <th>
                            {{ trans('web.dashboard_payment_methods_pages_index_page_table_header_availablity') }}
                        </th>
                        <th></th>
                    </tr>
                    @foreach($resources as $paymentMethod)
                    <tr>
                        <td class="text-center">
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $counter_offset + $loop->iteration }}
                            </h3>
                        </td>
                        <td>
                            <h3 class="contact-list-view-column-categ margin-top10 contact-details-view" style="font-weight: 400;">
                                {{ $paymentMethod->name }}
                            </h3>
                        </td>
                        <td>
                            <select class="form-control change-availability" data-methodid="{{$paymentMethod->id}}">
                                <option value="0" {{$paymentMethod->availability==0?' selected':''}}>
                                    {{ trans('web.dashboard_payment_methods_pages_index_page_table_inactive') }}
                                </option>
                                <option value="1" {{$paymentMethod->availability==1?' selected':''}}>
                                    {{ trans('web.dashboard_payment_methods_pages_index_page_table_active') }}
                                </option>
                            </select>
                        </td>
                        <td>
                            <div class="no-shadow btn-group pull-right" style="margin:0;padding:0;">
                                <button type="button" class="btn btn-sm edit-btn text-center margin-left-10 dropdown-toggle contact-edit-dots-shdw pad0" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-h fa-lg edit-btn-contact-ico-color"></i>
                                </button>
                                <ul class="dropdown-menu contact-dropdown pull-right" role="menu">
                                    <li>
                                        <a href="#">{{ trans('web.dashboard_branches_pages_index_page_edit_button') }}</a>
                                    </li>
                                    <li>
                                        <a href="#">{{ trans('web.dashboard_branches_pages_index_page_delete_button') }}</a>
                                    </li>
                                </ul>
                            </div>
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
<script>
$(document).ready(function () {
    // Setup of AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    // change availability of payment method
    $('.change-availability').on('change', function () {
        // Data for Ajax
        var changeMethodAvailabilityUrl = '{{ route('dashboard.payment_methods.availability') }}';
        var paymentMethodId = $(this).attr('data-methodid');
        var availability = $(this).val();
        // Send AJAX
        $.ajax({
            type: 'POST',
            url: changeMethodAvailabilityUrl,
            data: {
                'paymentMethodId': paymentMethodId,
                'availability': availability,
            },
            success: function (data) {
                swal('Success','Availability changed','success');
            },
            error: function (data) {
                swal('Opps !','Something went wrong','error');
            }
        });
    });

});
</script>
@stop
