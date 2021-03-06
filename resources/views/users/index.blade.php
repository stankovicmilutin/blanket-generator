@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Users List</h4>
                            <p class="card-category">List of all system users</p>
                        </div>

                        <div class="col-6 text-right">
                            <a class="btn btn-primary" href="{{ route('users.create') }}">Create new user</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table id="coursesTable" class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th style="max-width: 350px">Courses</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        (function () {
            $('#coursesTable').DataTable({
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                },
                "ajax": {
                    url: "users/get",
                    data: function (d) {
                        // console.log(d);
                    }
                },
                "processing": true,
                "serverSide": true,
                "columns": [
                    {data: 'id'},
                    {data: 'name'},{
                        data: 'courses',
                        render: data => data.map(c => c.name).join(', ')
                    },
                    {
                        data: null,
                        render: (
                            () => `<button onclick="window.location.href = '/users/' + $(this).closest('tr').data('id') + '/edit'" class="btn btn-link btn-warning"><i class="fa fa-edit"></i></button>
                                   <button class="btn btn-link btn-danger js-delete"><i class="fa fa-times"/></i></button>`)
                    }
                ],
                'createdRow': function (row, data, dataIndex) {
                    $(row).attr('data-id', data.id);
                },
                "initComplete": () => {
                    $(document).on("click", "tr[role='row'] .js-delete", (ev) => {
                        let itemId = $(ev.target.closest('tr')).data('id');
                        let url = `/users/${itemId}`;

                        swal.fire({
                            title: `Delete`,
                            text: `Are you sure you want to delete this item?`,
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Delete'
                        }).then((isConfirm) => {
                            if (isConfirm.dismiss) return;

                            window.axios.delete(url).then(res => {
                                $('#coursesTable').DataTable().ajax.reload();
                            });
                        });
                    });
                }
            });
        })();
    </script>
@endpush
