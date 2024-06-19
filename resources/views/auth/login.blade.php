@extends('auth.layout.app')

@section('content')
<div class="signin">
    <form method="POST" action="{{route('sample.validate_login')}}">
        @csrf
      <div class="title">Login</div>
      <div class="input-box underline">
        <input type="text" placeholder="Enter Your Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus required />
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="underline"></div>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Enter Your Password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" required />
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        <div class="underline"></div>
      </div>
      <div class="input-box button">
        <button type="submit"  class="btn btn-primary w-100">
            {{ __('Login') }}
        </button>
        <p>
          dont have an account? <span><u><a href="/registration">sign up</a></u></span>
        </p>
      </div>
    </form>
</div>

@endsection
