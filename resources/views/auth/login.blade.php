@extends('layouts.auth')
@push('heads')
  <style>
    .my-card {
      backdrop-filter: blur(1px)
    }

    body {
      height: 100vh;
    }
  </style>
@endpush
@section('content')
  <div class="row" style="height: 100vh; width: 100vw">
    <div class="col-md-6 p-0 h-100">
      <img src="/assets/img/bg-auth1.jpg" alt="" class="w-100 h-100" style="object-fit: cover">
    </div>
    <div class="col-md-6 p-0 d-flex justify-content-center align-items-center">
      <div class=" my-card w-100" style="max-width: 600px;">
        <h1 class="fw-bold text-center mb-5">SIGN IN</h1>

        <div class="card-body">
          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="mb-3">
              <div class="d-flex justify-content-between">
                <label for="password">Password</label>
                @if (Route::has('password.request'))
                  <a class="btn btn-link text-decoration-none" style="" href="{{ route('password.request') }}">
                    Lupa password
                  </a>
                @endif
              </div>
              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required
                autocomplete="current-password">
              @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>

              <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
              </label>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-5">
              {{ __('Login') }}
            </button>
            <p class="text-center mt-3">Belum punya akun ? <a href="{{ route('register') }}"
                class="text-decoration-none">Register</a></p>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
