@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-6 col-sm-8 ml-auto mr-auto">
        <form class="form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="card card-login card-hidden">
                <div class="card-header ">
                    <h3 class="header text-center">{{ __('Reset Password') }}</h3>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email"
                               type="email"
                               placeholder="Enter email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer ml-auto mr-auto text-center">
                    <button type="submit" class="btn btn-warning btn-wd">{{ __('Send Password Reset Link') }}</button>
                    <br/>
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Back to login') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
