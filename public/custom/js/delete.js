function type_delete(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var my_url = window.location.origin +"/type-delete/"+id;
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
    })


}
function form_delete(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var my_url = window.location.origin +"/form-delete/"+id;
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
    })


}
function removeField(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var my_url = window.location.origin +"/field-delete/"+id;
            $.ajax({
                type: 'get',
                url: my_url,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    toastr.success(data.message)
                    $(".table-field").load(location.href + " .table-field");
                },
                error: function (data) {
                    console.log(data)
                }
            });
        }
    })


}
