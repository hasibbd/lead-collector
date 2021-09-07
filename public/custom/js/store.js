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
    $('#form_submit_f').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);
        var  my_url = base + "/form-field-update";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $('#field_modal').modal('toggle')
                formReset();
                toastr.success(data.message)
                $(".table").load(window.location + " .table");

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
    $('#user_submit2').submit(function (e) {
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
                console.log(data)
                toastr.success(data.message)
                formReset();
            },
            error: function (data) {
                console.log(data.responseJSON)
                toastr.error(data.responseJSON.message)

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
                console.log(data)
                toastr.success(data.message)
                $('.table').DataTable().ajax.reload();
                formReset();
            },
            error: function (data) {
                console.log(data)
                toastr.error(data.responseJSON.message)

            }
        });
    });
    $('#user_forget').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var  my_url = base + "/user-forget";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data)
                toastr.success(data.message)
                $('.table').DataTable().ajax.reload();
                formReset();
            },
            error: function (data) {
                console.log(data)
                toastr.error(data.responseJSON.message)

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
    $('#remark_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);
        $('#rebtn').text('Sending Remark...').prop('disabled',true)
        var  my_url = base + "/remark-create";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                formReset();
                toastr.success(data.message)
                $('#rebtn').text('Add').prop('disabled',false)
                $('#application_list').DataTable().ajax.reload();

            },
            error: function (data) {
                Swal.fire(
                    'O ho!',
                    'User added Failed!',
                    'error'
                )
                $('#rebtn').text('Add').prop('disabled',false)
            }
        });
    });
    $('#man_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);
        $('#mansabtn').text('Sending Verification Link...').prop('disabled',true)

        var  my_url = base + "/mansha-create";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                formReset();
                toastr.success(data.message)
                $('#mansabtn').text('Add').prop('disabled',false)

            },
            error: function (data) {
                Swal.fire(
                    'O ho!',
                    'Failed, Try again',
                    'error'
                )
                $('#mansabtn').text('Add').prop('disabled',false)
            }
        });
    });
    $('#app_submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var  my_url = base + "/application";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                formReset();
                toastr.success(data.message)
                console.log(data)
                window.location.href = base +  "/profile";

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
    $('#update_app').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var  my_url = base + "/application-update";
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                formReset();
                toastr.success(data.message)
                console.log(data)
                window.location.href = base +  "/profile";

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
    $('#reset_pass').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var  my_url = base + "/reset-user-pass";
        if ($('#password').val() == $('#c_password').val()){
            $.ajax({
                type: 'post',
                url: my_url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    formReset();
                    toastr.success(data.message)
                    console.log(data)

                },
                error: function (data) {
                    Swal.fire(
                        'O ho!',
                        'User added Failed!',
                        'error'
                    )
                }
            });
        }else{
            toastr.error('Password did not matched');
        }

    });
    $('#profile_change').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);

        var  my_url = base + "/profile-update";
        if ($('#password').val() == $('#c_password').val()){
            $.ajax({
                type: 'post',
                url: my_url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    formReset();
                    toastr.success(data.message)
                },
                error: function (data) {
                    Swal.fire(
                        'O ho!',
                        'Profile update failed!',
                        'error'
                    )
                }
            });
        }else{
            toastr.error('Password did not matched');
        }

    });

});
