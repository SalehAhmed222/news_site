@extends('layouts.frontend.app')

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row d-flex justify-content-center" style="margin-left: 70px" >
                                {!! NoCaptcha::display() !!}
                            </div>

                            <div class="row d-flex justify-content-center" style="margin-left: 70px">
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block" style="color: red">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <br>
                            <div class="d-flex justify-content-center" style="gap: 20px;">
                                <div>
                                    <a class="btn btn-danger d-flex align-items-center"
                                       href="{{ route('auth.google.redirect', 'google') }}"
                                       style="display: flex; align-items: center; gap: 10px;">
                                        <i class="fab fa-google"></i>
                                        Login with Google
                                    </a>
                                </div>
                                <div>
                                    <a class="btn btn-primary d-flex align-items-center"
                                       href="{{ route('auth.google.redirect', 'facebook') }}"
                                       style="display: flex; align-items: center; gap: 10px;">
                                        <i class="fab fa-facebook-f"></i>
                                        Login with Facebook
                                    </a>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection


@push('js')
    {!! NoCaptcha::renderJs() !!}
@endpush
