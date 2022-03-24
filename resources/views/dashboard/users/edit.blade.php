@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex -justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1>Edit User</h1>
    </div>

    <div class="col-lg-8">
        <form method="post" action="/dashboard/users/{{ $user->username }}" class="mb-3">
            {{-- method put digunakan untuk melakukan update melalui model  --}}
            {{-- macam method dapat dilihat pada perintah php artisan route:list --}}
            @method('put')

            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">name</label>
              <input type="text" class="form-control @error ('name') is-invalid @enderror" id="name" name="name" required autofocus value="{{ old('name', $user->name) }}">
              {{-- old(nilai input, nilai database) --}}
              @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="username" class="form-label">username</label>
              <input type="text" class="form-control @error ('username') is-invalid @enderror" id="username" name="username" required value="{{ old('username', $user->username) }}">
              {{-- old(nilai input, nilai database) --}}
              @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">email</label>
              <input type="email" class="form-control @error ('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email', $user->email) }}">
              {{-- old(nilai input, nilai database) --}}
              @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control @error ('password') is-invalid @enderror" id="password" name="password" required value="{{ old('password', $user->password) }}">
                {{-- old(nilai input, nilai database) --}}
                @error('username')
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary" onclick="alert('Are you sure?')">Edit User</button>
          </form>
    </div>

@endsection