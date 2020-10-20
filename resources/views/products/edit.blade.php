@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Edit the product: {{ $product->reference }}</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @method("PATCH")
            @csrf
            <div class="row">
                <div class="form-group col-md-8">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="form-group col-md-4">
                    <label>Cost</label>
                    <input type="number" name="cost" class="form-control" min="0" value="{{ $product->cost }}"
                        placeholder="Write the description" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Save</button>
            <a href="{{ url('/products') }}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </form>
    </div>
@endsection
