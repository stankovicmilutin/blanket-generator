@extends('layouts.app')

@section('content')
    <style>
        /* Remove default bullets */
        #myUL {
            list-style-type: none;
        }

        /* Remove margins and padding from the parent ul */
        #myUL {
            margin: 0;
            padding: 0;
        }

        /* Style the caret/arrow */
        .caretH {
            cursor: pointer;
            user-select: none; /* Prevent text selection */
        }

        /* Create the caret/arrow with a unicode, and style it */
        .caretH::before {
            content: "\25B6";
            color: black;
            display: inline-block;
            margin-right: 6px;
        }

        /* Rotate the caret/arrow icon when clicked on (using JavaScript) */
        .caretH-down::before {
            transform: rotate(90deg);
        }

        /* Hide the nested list */
        .nested {
            display: none;
        }

        /* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
        .active {
            display: block;
        }
    </style>

    <div class="row">
        <div class="col-md-12">
            <div class="card" style="max-height: 90vh; overflow: auto">
                <div class="card-header">Blankets Database</div>

                <div class="card-body">
                    <ul id="myUL">
                        @foreach($modules as $module)
                            <li><span class="caretH">{{$module->name}}</span>
                                <ul class="nested">
                                    @foreach($module->courses as $course)
                                        <li><span class="caretH">{{ $course->name }}</span>
                                            <ul class="nested">
                                                @foreach($course->templates as $template)
                                                    <li><span class="caretH">{{$template->name}}</span>
                                                        <ul class="nested">
                                                            @foreach($template->blankets->groupBy(function($item) { return $item->date->format('Y'); }) as $year => $blankets)
                                                                <li><span class="caretH">{{ $year }}</span>
                                                                    <ul class="nested">
                                                                        @foreach($blankets as $blanket)
                                                                            @if ($blanket->file_path)
                                                                                <li><a href="{{ $blanket->file_path }}" target="_blank">{{ $blanket->examination_period }}</a></li>
                                                                            @else
                                                                                <li>{{ $blanket->examination_period }} (PDF not generated yet)</li>
                                                                            @endif
                                                                        @endforeach
                                                                    </ul>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        (function () {
            var toggler = document.getElementsByClassName("caretH");
            var i;

            for (i = 0; i < toggler.length; i++) {
                toggler[i].addEventListener("click", function () {
                    this.parentElement.querySelector(".nested").classList.toggle("active");
                    this.classList.toggle("caretH-down");
                });
            }
        })();
    </script>
@endpush
