@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

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

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" placeholder="Password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required
                                   autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" placeholder="Password" type="password"
                                   class="form-control @error('password-confirm') is-invalid @enderror"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password">

                            @error('password-confirm')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer ml-auto mr-auto text-center">
                        <button type="submit" class="btn btn-warning btn-wd">{{ __('Reset Password') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
