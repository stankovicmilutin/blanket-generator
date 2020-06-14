@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card stacked-form">
                <div class="card-header ">
                    <h5 class="card-title text-white bg-primary py-2 pl-2">Edit user</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                @include('users.form', [
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
