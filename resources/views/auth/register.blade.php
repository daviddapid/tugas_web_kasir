@extends('layouts.auth')
@push('heads')
  <style>
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
        <h1 class="fw-bold text-center mb-5">REGISTER</h1>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
              <label for="name">Name</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
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
            <div class="mb-3">
              <label for="password-confirm" class="form-label">Konfirmasi Password</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-5">
              {{ __('Sign Up') }}
            </button>
            <p class="text-center mt-3">Sudah punya akun ? <a href="{{ route('login') }}"
                class="text-decoration-none">Login</a></p>

          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
