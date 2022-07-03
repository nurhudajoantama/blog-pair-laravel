@extends('layouts.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5 pt-3">

        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
        @endif

        <main class="form-signin w-100 m-auto">
            <h1 class="h3 mb-3 fw- text-center">Login</h1>
            <form action="{{route('auth.postLogin')}}" method="POST">
                @csrf
                <div class="form-floating mb-4">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="name@example.com" autofocus required value="{{ old('email') }}">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-floating mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                        required>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
            </form>
            <div class="d-flex justify-content-center mt-2">
                <small>Not registered? <a href="/register">Register Here</a></small>
            </div>
        </main>
    </div>
</div>

@endsection