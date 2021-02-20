@extends('layouts.app')

@section('content')
<div class="container1">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card2" style=" background-color: #044c59; color: #fff;width: 450px;">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="group">
                            <label for="user" class="col-md-3">{{ __('E-Mail Address') }}</label>

                                <input id="user" type="text" style="color: black;" placeholder="Enter your email" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="group">
                            <label for="password" class="col-md-3">{{ __('Password') }}</label>

                                <input id="pass" type="text" style="color: black;" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="group">
                            <label for="pass" class="col-md-3">{{ __('Confirm Password') }}</label>
                            <input id="pass" type="text" style="color: black;" class="input" name="password_confirmation" required>
                        </div>

                        <div class="group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
