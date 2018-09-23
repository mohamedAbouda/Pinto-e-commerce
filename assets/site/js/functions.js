
function wishlist(id) {
    var path = {!! json_encode(route('web.wishlist.add')) !!}
    var id = id;

    $.ajax({
        type: "POST",

        url: path,
        data: {
           _token: "{{ csrf_token() }}",
           id: id
       },
       success: function(data) {
        swal("Done", "Add to Wish List!", "success");
    }
});
}

function addCompare(id) {
    var id = id;
    var path = {!! json_encode(route('web.add.compare.product')) !!}
    $.ajax({
        type: "POST",

        url: path,
        data: {
           _token: "{{ csrf_token() }}",
           id: id
       },
       success: function(data) {
        swal("Done", "Add to Compare List!", "success");
    }
});
}