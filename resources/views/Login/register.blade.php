@extends('main.guest')
@section('guest')
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <main class="form-register p-4 my-5" style="background: #0088005a;">
                <form action="/register" method="POST">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <img class="mb-4" src="{{ asset('img/logo/Logo_SN_noText.png') }}" alt="" width="100"
                            height="100">
                    </div>
                    <h1 class="h3 mb-5 fw-normal" style="text-align: center;">Please Sign In</h1>

                    <div class="form-floating mb-2">
                        <input type="text" name="name"
                            class="form-control border border-0 rounded rounded-4 @error('name') is-invalid @enderror"
                            id="name" placeholder="Name" value="{{ old('name') }}">
                        <label for="floatingInput">Name</label>
                        @error('name')
                            <div class="invalid-feedback mb-2"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" name="username"
                            class="form-control border border-0 rounded rounded-4 @error('username') is-invalid @enderror"
                            id="username" placeholder="Username" value="{{ old('username') }}">
                        <label for="floatingInput">Username</label>
                        @error('username')
                            <div class="invalid-feedback mb-2"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="email" name="email"
                            class="form-control border border-0 rounded rounded-4 @error('email') is-invalid @enderror"
                            id="email" placeholder="email@example.com" value="{{ old('email') }}">
                        <label for="floatingInput">Email address</label>
                        @error('email')
                            <div class="invalid-feedback mb-2"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" name="password"
                            class="form-control border border-0 rounded rounded-4 @error('password') is-invalid @enderror"
                            id="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        @error('password')
                            <div class="invalid-feedback mb-2"> {{ $message }} </div>
                        @enderror
                    </div>

                    <button class="btn w-100 py-2 mt-5" type="submit" style="background:#008800; color:white; font-weight:bold;">Register</button>

                    <small class="d-block text-center mt-3">Already have account 
                        <a href="/login" style="text-decoration:none; color:white; font-weight:bold;">Login!</a>
                    </small>
                    <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2023</p>
                </form>
            </main>
        </div>
    </div>
@endsection
