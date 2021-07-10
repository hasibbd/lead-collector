$(document).ready(function () {

    var base = window.location.origin;

    function formReset(){
        $(".select2bs4").val(null).trigger('change');
        $(".select2").val(null).trigger('change');
        $('.modal').modal('hide');
        $('form').trigger("reset");
    }
    $('#type_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        if ($('#sub_btn').val() === "add"){
            var  my_url = base + "/type-create";
        }else{
            var  my_url = base + "/type-update";
        }
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#add_modal').modal('toggle')
                formReset();
                toastr.success(data.message)
                $('.table').DataTable().ajax.reload();

            },
            error: function (data) {
                Swal.fire(
                    'O ho!',
                    'User added Failed!',
                    'error'
                )
            }
        });
    });
    $('#form_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        if ($('#sub_btn').val() === "add"){
            var  my_url = base + "/form-create";
        }else{
            var  my_url = base + "/form-update";
        }
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#add_modal').modal('toggle')
                formReset();
                toastr.success(data.message)
                $('.table').DataTable().ajax.reload();

            },
            error: function (data) {
                Swal.fire(
                    'O ho!',
                    'User added Failed!',
                    'error'
                )
            }
        });
    });
    $('#user_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        if ($('#sub_btn').val() === "add"){
            var  my_url = base + "/user-create";
        }else{
            var  my_url = base + "/user-update";
        }
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#add_modal').modal('toggle')
                formReset();
                toastr.success(data.message)
                $('.table').DataTable().ajax.reload();

            },
            error: function (data) {
                Swal.fire(
                    'O ho!',
                    'User added Failed!',
                    'error'
                )
            }
        });
    });
    $('#field_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var  my_url = base + "/field-create";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#add_modal').modal('toggle')
                formReset();
                toastr.success(data.message)
                $(".table-field").load(location.href + " .table-field");

            },
            error: function (data) {
                Swal.fire(
                    'O ho!',
                    'User added Failed!',
                    'error'
                )
            }
        });
    });

});
