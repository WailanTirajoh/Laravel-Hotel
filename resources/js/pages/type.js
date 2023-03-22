$(function() {
    const currentRoute = window.location.pathname;
    if(!currentRoute.startsWith('/type')) return

    const datatable = $("#type-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `/type`,
            type: 'GET',
            error: function(xhr, status, error) {

            }
        },
        "columns": [{
                "name": "number",
                "data": "number"
            },
            {
                "name": "name",
                "data": "name"
            },
            {
                "name": "information",
                "data": "information"
            },
            {
                "name": "id",
                "data": "id",
                "width": "100px",
                "render": function(typeId) {
                    return `
                        <button class="btn btn-light btn-sm rounded shadow-sm border"
                            data-action="edit-type" data-type-id="${typeId}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit type">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form class="btn btn-sm delete-type" method="POST"
                            id="delete-type-form-${typeId}"
                            action="/type/${typeId}">
                            <input type="hidden" name="_method" value="DELETE">
                            <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                href="#" type-id="${typeId}" type-role="type" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Delete type">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </form>

                    `
                }
            }
        ]
    });

    const modal = new bootstrap.Modal($("#main-modal"), {
        backdrop: true,
        keyboard: true,
        focus: true
    })

    $(document).on('click', '.delete', function() {
        var type_id = $(this).attr('type-id');
        var type_name = $(this).attr('type-name');
        var type_url = $(this).attr('type-url');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "Type will be deleted, You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel! ',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#delete-type-form-${type_id}`).submit();
            }
        })
    }).on('click', '#add-button', async function() {
        modal.show()

        $('#main-modal .modal-body').html(`Fetching data`)

        const response = await $.get(`/type/create`);
        if (!response) return

        $('#main-modal .modal-title').text('Create new type')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('click', '#btn-modal-save', function() {
        $('#form-save-type').submit()
    }).on('submit', '#form-save-type', async function(e) {
        e.preventDefault();
        CustomHelper.clearError()
        $('#btn-modal-save').attr('disabled', true)
        try {
            const response = await $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                method: $(this).attr('method'),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            })

            if (!response) return

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            })

            modal.hide()
            datatable.ajax.reload()
        } catch (e) {
            if (e.status === 422) {
                console.log(e)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: e.responseJSON.message,
                })
                CustomHelper.errorHandlerForm(e)
            }
        } finally {
            $('#btn-modal-save').attr('disabled', false)
        }
    }).on('click', '[data-action="edit-type"]', async function() {
        modal.show()

        $('#main-modal .modal-body').html(`Fetching data`)

        const typeId = $(this).data('type-id')

        const response = await $.get(`/type/${typeId}/edit`);
        if (!response) return

        $('#main-modal .modal-title').text('Edit type')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('submit', '.delete-type', async function(e) {
        e.preventDefault()

        try {
            const response = await $.ajax({
                url: $(this).attr('action'),
                data: $(this).serialize(),
                method: $(this).attr('method'),
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            })

            if (!response) return

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: response.message,
                showConfirmButton: false,
                timer: 1500
            })

            datatable.ajax.reload()
        } catch (e) {
            if(e && e.responseJSON && e.responseJSON.message) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: e.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }
    })
});
