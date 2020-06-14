<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

    <title>{{ $blanket->template->name ."-". $blanket->examination_period }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /*! normalize.css v3.0.3 | MIT License | github.com/necolas/normalize.css */
        html {
            /*font-family: sans-serif;*/
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        body {
            margin: 0;
        }
        b,
        strong {
            font-weight: bold;
        }
        hr {
            height: 0;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }
    </style>

    <style>
        @page {
            size: 7in 9.25in;
        }

        body {
            font-family: 'Lora', sans-serif;
            font-size: 13px;
        }

        h3 {
            margin-top: 0.7em;
            margin-bottom: 0.5em;
            font-weight: 700;
        }

        h4 {
            margin-top: 0.6em;
            margin-bottom: 0.2em;
            font-weight: 500 !important;
        }

        .container {
            background-color: #fff;
            max-width: 1140px;
            margin-right: auto;
            margin-left: auto;
        }

        .pt-3 {padding-top: 0.4em}

        .justify-content-center {
            justify-content: center !important;
        }

        .pull-left {float:left}
        .pull-right {float:right}
        .text-center { text-align: center;}
        .text-right { text-align: right;}

        .col-12, .col-9, .col-1 {
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-1 {
            float: left;
            width: 3%;
        }

        .col-9 {
            float: left;
            width: 90%;
        }

        .col-12 {
            max-width: 100%;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .row:after .row:before {
            display: table;
            content: " ";
        }
        .row:after {clear: both}

        .clearfix {clear: both}

        .task-body p {
            padding: 0;
            margin: 0 0 10px 0;
        }
    </style>

</head>
<body>

<div class="container">
    <div class="blanket">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="pull-left" style="width: 50%">
                            <div>Univerzitet u Nišu</div>
                            <div>Elektronski Fakultet</div>
                            <div>{{ $blanket->template->course->department->name }}</div>
                        </div>
                        <div class="pull-left text-right" style="width: 50%">
                            <div>{{ $blanket->date->format('d.m.Y.') }}</div>
                            <div>Ispitni rok: {{ $blanket->examination_period }}</div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <hr/>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="text-center clearfix">{{ $blanket->template->name }}</h3>
                            </div>
                        </div>
                        @php $taskIndex = 0; $taskCounter = 1;@endphp

                        @foreach($blanket->template->elements as $element)

                            @if($element->type == 'separator')
                                <hr/>
                            @endif

                            @if($element->type == 'heading')
                                @php $taskCounter = 1; @endphp
                                <h4>{{ $element->text }}</h4>
                            @endif

                            @if($element->type == 'task')
                                <div class="row pt-3">
                                    <div class="col-1 text-right">{{$taskCounter++}}.</div>
                                    <div class="col-9 task-body">{!! $blanket->tasks[$taskIndex++]->body !!}</div>
                                </div>
                            @endif

                        @endforeach

                    </div>

                    <hr style="margin-top: 30px"/>
                    <div class="text-right" style="margin: 10px 60px 30px 0">Predmetni nastavnik</div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
