@extends('layouts.app')

@section('content')
        <div class="container-fluid">
            @include('settings.partials.job-types-table')
            @include('settings.partials.job-extras-table')
            @include('settings.partials.job-extras-tyre-types')
        </div>
@endsection

@push('js')
    <script>
        (function($) {
            $('.js-sweet-alert').on('click', function(e) {
                e.preventDefault();

                let info = $(e.currentTarget).data('info');

                swal.fire({
                    title: `Delete ${info.type}`,
                    text: `Are you sure you want to delete ${info.type} '${info.name}'?`,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Delete'
                }).then((isConfirm) => {
                    if (isConfirm.dismiss) return;
                    deleteItem($(e.currentTarget).attr('href'));
                });

                const deleteItem = (link) => {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'DELETE',
                        url: link,
                    }).done((res) => {
                        if(res.success) {
                            window.location.reload();
                        }
                    });
                }
            });
        })($);
    </script>
@endpush
