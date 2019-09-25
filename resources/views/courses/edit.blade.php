@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h5 class="card-title text-white bg-primary py-2 pl-2">Edit course</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        @include('courses.form', [
                            'course' => $course,
                            'buttonText' => 'Update course'
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

