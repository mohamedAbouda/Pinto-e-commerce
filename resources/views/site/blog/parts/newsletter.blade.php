<aside class="widget widget_newletters">
    <h3 class="widget-title">Newletters</h3>
    <div class="newletter-form">
        <form action="{{ route('web.subscribe') }}" method="POST">
            {{ csrf_field() }}
            <input type="text" name="email" placeholder="Email Adress..." class="form-control" required>
            <button type="submit" class="btn btn-submit">Submit</button>
        </form>
    </div>
</aside>
