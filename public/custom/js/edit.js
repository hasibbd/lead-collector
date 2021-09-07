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
function appView(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var my_url = window.location.origin +"/application-get/"+id;
    $.ajax({
        type: 'get',
        url: my_url,
        cache: false,
        contentType: false,
        processData: false,
        success: (data) => {

            $('#mdl_ttl').text(data.application_name)
            $('#a_name').text(data.application_name)
            $('#a_id').text(data.application_id)
            $('#id').val(data.application_id)
            $('#id2').val(data.application_id)
            if (data.application_status == 1){
                $('#a_status').text('Approved')
            }else if (data.application_status == 0){
                $('#a_status').text('Pending')
            }
            else if (data.application_status == -2){
                $('#a_status').text('Re-submitted')
            }else{
                $('#a_status').text('Requested for edit')
            }
            $('#res_table tbody').empty();
            $.each(data.results, function(key,item) {
               if (item.type != 'note'){
                   if (item.type == 'file'){
                       if (item.result){
                           $('#res_table tbody').append('<tr><td>'+item.label+'</td><td><a href="'+window.location.origin+'/uploads/files/'+item.result+'" download>Download/View</a></td></tr>');
                       }else{
                           $('#res_table tbody').append('<tr><td>'+item.label+'</td><td>N/A</td></tr>');
                       }

                   }else{
                       $('#res_table tbody').append('<tr><td>'+item.label+'</td><td>'+item.result+'</td></tr>');
                   }
               }
            });
            if (data.remarks == ""){
                $('#t_hide').hide()
            }else{
                $('#t_hide').show()
                $('#remarks_table tbody').empty()
                $.each(data.remarks, function(key,item) {
                    console.log(item)
                    $('#remarks_table tbody').append('<tr><td>'+new Date(item.created_at).toLocaleString()+' <br> <span class="font-weight-bold">'+item.remarks+'</span></td></tr>');
                })
            }
            $('#sha_table > tbody').empty()
            $.each(data.share, function(key,item) {
                $('#sha_table > tbody').append('<tr><td>'+item.name+' <br> <span class="font-weight-bold">'+item.email+'</span></td><td>'+item.status+'</td></tr>');
            });
            $('#man_table > tbody').empty()
            $.each(data.manager, function(key,item) {
                console.log('ad',item)
                $('#man_table > tbody').append('<tr><td>'+item.name+' <br> <span class="font-weight-bold">'+item.email+'</span></td><td>'+item.status+'</td></tr>');
            });

            $('#add_modal').modal('toggle')


        },
        error: function (data) {
            console.log(data)
        }
    });
}
