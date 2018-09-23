<table class="table">
    <thead>
        <tr>
            <th>
                No
            </th>
            <th>
                Title
            </th>
            <th>
                Description
            </th>
            <th>
                Image
            </th>
            <th>
                Set to collection
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($resources as $resource)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                {{ $resource->title }}
            </td>
            <td>
                <p>{{ str_limit( $resource->description, 80, '..') }}</p>
            </td>
            <td>
                <img style="max-height: 100%;max-width: 100%;" src="{{ url('storage/app/'.$resource->image) }}">
            </td>
            <td>
                <?php $in = in_array($resource->id , $collection_products_ids);?>
                <a href="#" class="btn btn-{{ $in?'danger':'primary' }}"
                onclick="toggleCollection(this);"
                data-text-1="Add to collection" data-text-2="Remove from collection"
                data-target="{{ route('dashboard.collection.productCollection' , [$resource->id,$product->id]) }}">
                    @if($in)
                    Remove from collection
                    @else
                    Add to collection
                    @endif
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
