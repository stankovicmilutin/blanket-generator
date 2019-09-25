@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h5 class="card-title text-white bg-primary py-2 pl-2">Create course</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        @include('courses.form', [
                            'course' => \App\Course::make(),
                            'buttonText' => 'Create course'
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection