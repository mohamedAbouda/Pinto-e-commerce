    @extends('dashboard.app')
    @section('title',"{$service->title}")
    @section('description','بيانات الخدمة')
    @section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        </tr>
                        @if($service->title)
                        <tr>
                            <td>العنوان</td>
                            <td>{{ $service->title }}</td>
                        </tr>
                        @endif
                    
                        
                    
                        <tr>
                            <td>الوصف</td>
                            <td>{!! $service->description !!}</td>
                        </tr>
                        
                        <tr>
                            <td>الصورة</td>
                            <td>
                            <img src="{{ $service->image_path }}" style="width: 200px; height: 200px;" alt="">
                            </td>
                        </tr>
                     
                        
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <div class="text-center">
                    
                </div>
            </div>
        </div>
    </div>
    @endsection