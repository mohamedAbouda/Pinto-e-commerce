<aside class="widget widget_category">
    <h3 class="widget-title">Categories / Tags</h3>
    <ul>
        @foreach($tags as $tag)
        <li>
            <a href="{{ route('web.blog.index' ,['tag' => $tag->name]) }}">
                {{ $tag->name }}
            </a>{{ $tag->articles()->count() }}
        </li>
        @endforeach
    </ul>
</aside>
