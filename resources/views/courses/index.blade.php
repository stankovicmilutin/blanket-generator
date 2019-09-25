@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="card-title">Courses List</h4>
                            <p class="card-category">List of all courses</p>
                        </div>

                        <div class="col-6 text-right">
                            <a class="btn btn-primary" href="{{ route('courses.create') }}">Create new course</a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table id="coursesTable" class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Department</th>
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
                    url: "courses/get",
                    data: function (d) {
                        // console.log(d);
                    }
                },
                "processing": true,
                "serverSide": true,
                "columns": [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'department_name'},
                    {
                        data: null,
                        render: (() => `
                                           <button onclick="window.location.href = '/courses/' + $(this).closest('tr').data('id') + '/edit'" class="btn btn-link btn-warning"><i class="fa fa-edit"></i></button>
                                           <button class="btn btn-link btn-danger js-delete-course"><i class="fa fa-times"></i></button>
                                       `)
                    }
                ],

                'createdRow': function (row, data, dataIndex) {
                    $(row).attr('data-id', data.id);
                }
            });
        })();
    </script>
@endpush
