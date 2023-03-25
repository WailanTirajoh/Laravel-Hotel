$(function() {
    const currentRoute = window.location.pathname;
    if(!currentRoute.split('/').includes('roomstatus')) return

    const datatable = $("#roomstatus-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: `/roomstatus`,
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
                "name": "code",
                "data": "code"
            },
            {
                "name": "information",
                "data": "information"
            },
            {
                "name": "id",
                "data": "id",
                "width": "100px",
                "render": function(roomstatusId) {
                    return `
                        <button class="btn btn-light btn-sm rounded shadow-sm border"
                            data-action="edit-roomstatus" data-roomstatus-id="${roomstatusId}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit roomstatus">
                            <i class="fas fa-edit"></i>
                        </button>
                        <form class="btn btn-sm delete-roomstatus" method="POST"
                            id="delete-roomstatus-form-${roomstatusId}"
                            action="/roomstatus/${roomstatusId}">
                            <input type="hidden" name="_method" value="DELETE">
                            <a class="btn btn-light btn-sm rounded shadow-sm border delete"
                                href="#" roomstatus-id="${roomstatusId}" roomstatus-role="roomstatus" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Delete roomstatus">
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
        var roomstatus_id = $(this).attr('roomstatus-id');
        var roomstatus_name = $(this).attr('roomstatus-name');
        var roomstatus_url = $(this).attr('roomstatus-url');
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
                $(`#delete-roomstatus-form-${roomstatus_id}`).submit();
            }
        })
    }).on('click', '#add-button', async function() {
        modal.show()

        $('#main-modal .modal-body').html(`Fetching data`)

        const response = await $.get(`/roomstatus/create`);
        if (!response) return

        $('#main-modal .modal-title').text('Create new roomstatus')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('click', '#btn-modal-save', function() {
        $('#form-save-roomstatus').submit()
    }).on('submit', '#form-save-roomstatus', async function(e) {
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
    }).on('click', '[data-action="edit-roomstatus"]', async function() {
        modal.show()

        $('#main-modal .modal-body').html(`Fetching data`)

        const roomstatusId = $(this).data('roomstatus-id')

        const response = await $.get(`/roomstatus/${roomstatusId}/edit`);
        if (!response) return

        $('#main-modal .modal-title').text('Edit Room Status')
        $('#main-modal .modal-body').html(response.view)
        $('.select2').select2();
    }).on('submit', '.delete-roomstatus', async function(e) {
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
