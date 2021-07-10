function call_add_modal(){
    formReset();
    $('#mdl_ttl').text('Add New')
    $('#sub_btn').text('Save').val('add')
    $('#add_modal').modal('toggle')
}
function formReset(){
    $(".select2bs4").val(null).trigger('change');
    $(".select2").val(null).trigger('change');
    $('.modal').modal('hide');
    $('form').trigger("reset");
}
