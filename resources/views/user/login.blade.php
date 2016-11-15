@extends('layouts.master')

@section('title')
    Login and Register
@endsection

@section('main')
    <main>
        <div class="container">
            <div class="col-md-6">
                <h3>Login</h3>
                <div class="form-group">
                    <label for="login-username">Username or Email</label>
                    <input id="login-username" class="form-control" name="username" type="text" required/>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input id="login-password" class="form-control" name="password" type="password" required/>
                </div>
            </div>
            <div class="col-md-6">
                <h3>Register</h3>
                <div class="form-group">
                    <label for="login-username">Username *</label>
                    <input id="login-username" class="form-control" name="username" type="text" required/>
                </div>
                <div class="form-group">
                    <label for="login-email">Email *</label>
                    <input id="login-email" class="form-control" name="email" type="text" required/>
                </div>
                <div class="form-group">
                    <label for="login-password">Password *</label>
                    <input id="login-password" class="form-control" name="password" type="password" required/>
                </div>
            </div>
        </div>
    </main>
@endsection
