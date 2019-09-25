@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @push('scripts')
            <script>
                (() => {
                    let level = '{{ $message['level'] }}';

                    toastr.options = {
                        "positionClass": "toast-bottom-right"
                    };

                    toastr[level]('{{ $message['message'] }}', '{{ $message['title'] != 'Notice' ? $message['title'] : '' }}');
                })();
            </script>
        @endpush
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
        {{ $message['important'] ? 'alert-important' : '' }}"
             role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

{{ session()->forget('flash_notification') }}
