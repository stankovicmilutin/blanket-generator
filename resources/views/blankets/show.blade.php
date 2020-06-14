@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header text-right">
                    <a href="{{ url()->previous() }}">
                        <button class="btn btn-primary">Back</button>
                    </a>
                </div>
                <div class="card-body">
                    @include('blankets.pdf')
                </div>
            </div>
        </div>
    </div>
@endsection
