@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card1">
                <div class="login-box">
                    <div class="login-snip"><a class="logo"><img src="images/pp-icon.png" alt="logo"  height="50" width="90"/></a>
                        <div clas="line-divider"></div>
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
                        <div class="login-space">
                            <div class="login">
                                <form method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="group"> <label for="user" class="label">{{ __('E-Mail Address') }}</label>
                                    <input id="user" type="text"  placeholder="Enter your username" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email')?old('email'):'aamirengr001@gmail.com' }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="group"> <label for="pass" class="label">{{ __('Password') }}</label>
                                    <input id="pass" type="password" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" data-type="password" placeholder="Enter your password" name="password" value="12345678" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="group"> <input id="check" type="checkbox" class="check" {{ old('remember') ? 'checked' : '' }}> <label for="check"><span class="icon"></span>{{ __('Remember Me') }}</label> </div>
                                    <div class="group"> <input type="submit" class="button" value="{{ __('Login') }}"></div>
                                    <div class="hr"></div>
                                    <div class="foot">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                        </div>
                                </form>
                                </div>
                                <div class="sign-up-form">
                                <form method="POST" action="{{ route('register') }}">
                                @csrf

                                    <div class="group"> <label for="user" class="label">{{ __('Name') }}</label>
                                    <input id="user" type="text" class="input {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Enter your name" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="group"> <label for="pass" class="label">{{ __('E-Mail Address') }}</label>
                                        <input id="pass" type="text" class="input {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Enter your email address" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="group"> <label for="pass" class="label">{{ __('Password') }}</label>
                                            <input id="pass" type="password" class="input {{ $errors->has('password') ? ' is-invalid' : '' }}" data-type="password" placeholder="Create your password" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="group"> <label for="pass" class="label">{{ __('Confirm Password') }}</label>
                                            <input id="pass" type="password" class="input" data-type="password" placeholder="Repeat your password" name="password_confirmation" required>
                                        </div>
                                    <div class="group"> <input type="submit" class="button" value="{{ __('Register') }}"> </div>
                                    <div class="hr"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card">
             <a href="index.html" class="logo"><img src="images/pp-icon.png" alt="logo"  height="50" width="90"/></a>
					<h2 class="text-white" style="padding-bottom: 30px; padding-top: 20px;">Socialize Yourself</h2>
					<div class="line-divider"></div>
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email')?old('email'):'aamirengr001@gmail.com' }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="12345678" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
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
                    </form>
                </div>
            </div> -->
            
            <svg class="arrows hidden-xs hidden-sm">
                <path class="a1" d="M0 0 L30 32 L60 0"></path>
                <path class="a2" d="M0 20 L30 52 L60 20"></path>
                <path class="a3" d="M0 40 L30 72 L60 40"></path>
            </svg>
        </div>
    </div>
</div>

@endsection
@section('introduction')
<!-- Features Section
    ================================================= -->
    <section id="features">
			<div class="container wrapper">
				<h1 class="section-title slideDown">Public Place</h1>
				<div class="row slideUp">
					<div class="feature-item col-md-2 col-sm-6 col-xs-6 col-md-offset-2">
						<div class="feature-icon"><i class="icon ion-person-add"></i></div>
						<h3>Make Friends</h3>
					</div>
					<div class="feature-item col-md-2 col-sm-6 col-xs-6">
						<div class="feature-icon"><i class="icon ion-images"></i></div>
						<h3>Publish Posts</h3>
					</div>
					<div class="feature-item col-md-2 col-sm-6 col-xs-6">
						<div class="feature-icon"><i class="icon ion-chatbox-working"></i></div>
						<h3>Public Group Chats</h3>
					</div>
					<div class="feature-item col-md-2 col-sm-6 col-xs-6">
						<div class="feature-icon"><i class="icon ion-compose"></i></div>
						<h3>Public Status/Stories</h3>
					</div>
				</div>
            </div>

		</section>
    <!-- Image Divider
    ================================================= -->
    <div class="img-divider hidden-sm hidden-xs"></div>

@endsection