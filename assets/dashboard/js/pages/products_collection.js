$(document).ready(function(){
    $('.set-to-collection').click(function(e){
        e.preventDefault();
        var target = $(this).attr('data-target');
        $.ajax({
            url: target,
            type: 'GET',
            dataType: 'json',
            cache: false,
            success: function(response){
                $('#productsForCollection').find('.modal-body').html(response.html);
                $('#productsForCollection').modal('show');
            }
        });
    });
});

function toggleCollection(btn)
{
    var btn = $(btn);
    var btn_text = btn.text().trim()==btn.attr('data-text-1')?btn.attr('data-text-2'):btn.attr('data-text-1');
    var btn_class = btn.hasClass('btn-danger')?'btn-danger':'btn-primary';
    btn.removeClass(btn_class).addClass('btn-warning').button('loading');

    var token = $('input[name=_token]').val();
    var target = btn.attr('data-target');

    $.ajax({
        url: target,
        type: 'POST',
        dataType: 'json',
        data: {
            _token: token
        },
        cache: false,
        success: function(response){
            var next_class = (btn_class == 'btn-danger')?'btn-primary':'btn-danger';
            btn.removeClass('btn-warning').addClass(next_class)
            .button('stop').text(btn_text);
        }
    });
}
