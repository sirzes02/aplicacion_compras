@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Add new rol</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/roles" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Write the name" required>
            </div>
            <div class="form-group">
                <label>Label</label>
                <textarea name="label" rows="3" class="form-control"></textarea>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary mr-2">Create</button>
                <a href="{{ url('/roles') }}">
                    <button type="button" class="btn btn-danger">Cancel</button>
                </a>
            </div>
        </form>
    </div>
@endsection
