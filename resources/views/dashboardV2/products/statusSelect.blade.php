@if($product->featured == 1)
<option disabled selected>{{ trans('web.dashboard_products_status_select_change') }}</option>
<option value="2">{{ trans('web.dashboard_products_status_select_rqt') }}</option>
<option value="3">{{ trans('web.dashboard_products_status_select_app') }}</option>
<option value="4">{{ trans('web.dashboard_products_status_select_dis') }}</option>
<option value="5">{{ trans('web.dashboard_products_status_select_remove') }}</option>
@elseif($product->featured == 2)
<option disabled >{{ trans('web.dashboard_products_status_select_change') }}</option>
<option value="2" selected>{{ trans('web.dashboard_products_status_select_rqt') }}</option>
<option value="3">{{ trans('web.dashboard_products_status_select_app') }}</option>
<option value="4">{{ trans('web.dashboard_products_status_select_dis') }}</option>
<option value="5">{{ trans('web.dashboard_products_status_select_remove') }}</option>
@elseif($product->featured == 3)
<option disabled >{{ trans('web.dashboard_products_status_select_change') }}</option>
<option value="2">{{ trans('web.dashboard_products_status_select_rqt') }}</option>
<option value="3" selected>{{ trans('web.dashboard_products_status_select_app') }}</option>
<option value="4">{{ trans('web.dashboard_products_status_select_dis') }}</option>
<option value="5">{{ trans('web.dashboard_products_status_select_remove') }}</option>
@elseif($product->featured == 4)
<option disabled >{{ trans('web.dashboard_products_status_select_change') }}</option>
<option value="2">{{ trans('web.dashboard_products_status_select_rqt') }}</option>
<option value="3">{{ trans('web.dashboard_products_status_select_app') }}</option>
<option value="4" selected>{{ trans('web.dashboard_products_status_select_dis') }}</option>
<option value="5">{{ trans('web.dashboard_products_status_select_remove') }}</option>
@elseif($product->featured == 5)
<option disabled >{{ trans('web.dashboard_products_status_select_change') }}</option>
<option value="2">{{ trans('web.dashboard_products_status_select_rqt') }}</option>
<option value="3">{{ trans('web.dashboard_products_status_select_app') }}</option>
<option value="4">{{ trans('web.dashboard_products_status_select_dis') }}</option>
<option value="5" selected>{{ trans('web.dashboard_products_status_select_remove') }}</option>
@else
<option disabled selected>{{ trans('web.dashboard_products_status_select_change') }}</option>
<option value="2">{{ trans('web.dashboard_products_status_select_rqt') }}</option>
<option value="3">{{ trans('web.dashboard_products_status_select_app') }}</option>
<option value="4">{{ trans('web.dashboard_products_status_select_dis') }}</option>
<option value="5">{{ trans('web.dashboard_products_status_select_remove') }}</option>
@endif
