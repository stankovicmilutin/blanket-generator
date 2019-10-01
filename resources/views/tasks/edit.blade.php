@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h5 class="card-title text-white bg-primary py-2 pl-2">Create template</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="text-center p-2">{{ $course->name }} ({{ $course->module->name }})</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @include('tasks.form', [
                                        "course" => $course,
                                        "domains" => $course->domains,
                                        "buttonText" => "Update"
                                   ])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection