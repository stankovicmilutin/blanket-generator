@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h5 class="card-title text-white bg-primary py-2 pl-2">Create user</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf

                                @include('users.form', [
                                    "user" => \App\User::make(),
                                    "buttonText" => "Create"
                                ])
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
