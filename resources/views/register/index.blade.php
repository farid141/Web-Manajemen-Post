@extends('layouts.main')    
@section('container')

<div class="row justify-content-center">
    <div class="col-lg-5">
        
        <main class="form-registration">
            <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
          <form action="/register" method="post">
            {{-- <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
            @csrf
            <div class="form-floating">
                <input type="text" class="form-control rounded-top @error('name') is-invalid @enderror" name="name" id="name" placeholder="name" required value="{{ old('name') }}">
                <label for="name">Name</label>
                @error('name')
                    <div class="invalid-feedback">
                        <p>{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" placeholder="username" required value="{{ old('username') }}">
                <label for="username">Userame</label>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" required value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-floating">
                <input type="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback display">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        
            {{-- <div class="checkbox mb-3">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div> --}}
            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Register</button>
          </form>
          <small class="d-block text-center mt-3">
              Already registered? <a href="/login">login now!</a>
          </small>
        </main>
    </div>
</div>
    
@endsection