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
function profileModal(name) {
    $('#'+name).modal('toggle');
}
function editField(data) {
    console.log(data)
    $("#type_m").val(data.t_id).trigger('change');
    $('#label_m').val(data.label);
    $('#option_m').text(data.option);
    $('#id_m').val(data.id);
    $('#field_modal').modal('toggle');
}
