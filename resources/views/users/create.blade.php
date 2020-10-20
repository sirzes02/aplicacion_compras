@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Add new user</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/users" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Write your name" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Write your email" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Password confirmation</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Password"
                        required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Role</label>
                    <select id="select2" name="rol" class="form-control">
                        <option selected disabled>Choose a Role for this user...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Register</button>
            <a href="{{ url('/users') }}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js" defer></script>
    <script>
        $(document).ready(function() {
            $('#select2').select2();
        });

    </script>
@endsection
