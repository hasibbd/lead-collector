function formReset(){
    $(".select2bs4").val(null).trigger('change');
    $(".select2").val(null).trigger('change');
    $('.modal').modal('hide');
    $('form').trigger("reset");
}
function type_edit(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_url = window.location.origin +"/type-get/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            formReset()
            $('#type').val(data.info.type)
            $('#id').val(data.info.id)
            $('#mdl_ttl').text('Update')
            $('#sub_btn').text('Update').val('update')
            $('#add_modal').modal('toggle')


        },
        error: function (data) {
            console.log(data)
        }
    });
}
function form_edit(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_url = window.location.origin +"/form-get/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            formReset()
            $('#name').val(data.info.type)
            $('#id').val(data.info.id)
            $('#mdl_ttl').text('Update')
            $('#sub_btn').text('Update').val('update')
            $('#add_modal').modal('toggle')


        },
        error: function (data) {
            console.log(data)
        }
    });
}
function user_edit(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_url = window.location.origin +"/user-get/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {
            formReset()
            $('#name').val(data.info.name)
            $('#email').val(data.info.email)
            $('#phone').val(data.info.phone)
            $('#id').val(data.info.id)
            $('#mdl_ttl').text('Update')
            $('#sub_btn').text('Update').val('update')
            $('#add_modal').modal('toggle')


        },
        error: function (data) {
            console.log(data)
        }
    });
}

