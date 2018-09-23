@if($product->featured == 2)
{{ trans('web.dashboard_products_status_rqt') }}
@elseif($product->featured == 3)
{{ trans('web.dashboard_products_status_app') }}
@elseif($product->featured == 4)
{{ trans('web.dashboard_products_status_dis') }}
@elseif($product->featured == 5)
{{ trans('web.dashboard_products_status_remove') }}
@else
{{ trans('web.dashboard_products_status_un') }}
@endif