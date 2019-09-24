@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!

                        -- Total Blankets
                        -- Blankets this week
                        -- Blanket views
                        -- Top 5 popular blankets
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
