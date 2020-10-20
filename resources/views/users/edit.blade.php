@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit the user: {{ $user->name }}</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @method("PATCH")
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}"
                        placeholder="Escribe tu nombre" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                        placeholder="Escribe tu email" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Password <span class="small">(Optional)</span></label>
                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                </div>
                <div class="form-group col-md-6">
                    <label>Password confirmation <span class="small">(Optional)</span></label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Contraseña">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="email">Role</label>
                    <select id="select2" name="rol" class="form-control">
                        <option selected disabled>Choose a Role for this user...</option>
                        @foreach ($roles as $role)
                            @if ($role->name == str_replace(['["', '"]'], '', $user->tieneRol()))
                                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                            @else
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Save</button>
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
