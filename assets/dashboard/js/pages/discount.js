$(function() {
    $('.datetimepicker').datetimepicker({
        inline: true,
        useCurrent: false
    }).on('dp.change', function(e){
        var mysql_date_time = moment(e.date._d.toISOString())
        .format('YYYY-MM-DD HH:mm:ss');
        $(this).next().val(mysql_date_time);
    });
    var datetime_from = $('#datetime-from').attr('data-default-date');
    $('#datetime-from').data('DateTimePicker').date(new Date(datetime_from));
    var datetime_to = $('#datetime-to').attr('data-default-date');
    $('#datetime-to').data('DateTimePicker').date(new Date(datetime_to));
});
