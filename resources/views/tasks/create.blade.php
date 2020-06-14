@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h5 class="card-title text-white bg-primary py-2 pl-2">Create task</h5>
                </div>
                <div class="card-body">
                    @if(request()->filled('course'))
                        <div class="row">
                            <div class="col-12">
                                <h4 class="text-center p-2">{{ $course->name }} ({{ $course->module->name }})</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <form action="{{ route('tasks.store') }}" method="POST">
                                    @csrf

                                    @include('tasks.form', [
                                        "course" => $course,
                                        "task" => \App\Task::make(),
                                        "domains" => $course->domains,
                                        "buttonText" => "Create"
                                    ])
                                </form>
                            </div>
                        </div>
                    @else
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Course</label>
                                        <select name="course" class="form-control {{ $errors->has('course_id') ? ' is-invalid' : '' }}" name="course_id">
                                            <option value="" selected disabled>Select Course</option>
                                            @foreach($courses as $c)
                                                <option value="{{ $c->id }}" {{ (request()->get('course') == $c->id || old('course_id') === $c->id) ? ' selected' : '' }} >
                                                    {{ $c->name }} ({{ $c->module->name }})
                                                </option>
                                            @endforeach
                                        </select>
                                        @include('layouts.partials.form-error', ['field' => 'course_id'])
                                    </div>
                                    <div class="form-group">
                                        <label> </label>
                                        <button type="submit" class="btn btn-outline-primary">Select</button>
                                    </div>

                                    @if($courses->count() == 0)
                                        <div class="alert alert-warning" role="alert">
                                            You have no courses assigned. Please contact administrator!
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
