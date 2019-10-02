@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h5 class="card-title text-white bg-primary py-2 pl-2">Create blanket</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-center p-2">{{ $course->name }} ({{ $course->module->name }})</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @include('blankets.form', ["course" => $course, 'blanket' => $blanket])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection