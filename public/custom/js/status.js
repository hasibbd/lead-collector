function type_status(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_url = window.location.origin +"/type-status/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            toastr.success(data.message)
            $('.table').DataTable().ajax.reload();
        },
        error: function (data) {
            console.log(data)
        }
    });
}
function form_status(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_url = window.location.origin +"/form-status/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            toastr.success(data.message)
            $('.table').DataTable().ajax.reload();
        },
        error: function (data) {
            console.log(data)
        }
    });
}
function user_status(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_url = window.location.origin +"/user-status/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            toastr.success(data.message)
            $('.table').DataTable().ajax.reload();
        },
        error: function (data) {
            console.log(data)
        }
    });
}
