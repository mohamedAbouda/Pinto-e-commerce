<aside class="widget widget_social">
    <h3 class="widget-title">Social</h3>
    <div class="social">
        <a href="{{ $contact_details && $contact_details->twitter ? $contact_details->twitter : '#' }}" title="twitter" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-twitter"></i>
        </a>
        <a href="{{ $contact_details && $contact_details->facebook ? $contact_details->facebook : '#' }}" title="facebook" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-facebook"></i>
        </a>
        <a href="{{ $contact_details && $contact_details->google ? $contact_details->google : '#' }}" title="google plus" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-google-plus"></i>
        </a>
        <a href="{{ $contact_details && $contact_details->instagram ? $contact_details->instagram : '#' }}" title="instagram" target="_blank" rel="noopener noreferrer">
            <i class="fa fa-instagram"></i>
        </a>
    </div>
</aside>
