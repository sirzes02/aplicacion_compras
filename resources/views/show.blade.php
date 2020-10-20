@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Data of product: {{ $product->reference }}</h3>

        <form action="/home/add" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group col-md-12">
                    <label>Reference</label>
                    <input disabled type="numberclass=" form-control" value="{{ $product->reference }}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-8">
                    <label>Description</label>
                    <textarea disabled class="form-control" name="description"
                        rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="form-group col-md-4">
                    <label>Cost</label>
                    <input disabled type="number" name="cost" class="form-control" min="0" value="{{ $product->cost }}">
                </div>
            </div>

            <input type="number" style="visibility: hidden" name="reference" class="form-control"
                value="{{ $product->reference }}">

            <div class="row">
                <div class="form-group col-md-1">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" min="1" max="3" value="1">
                </div>
            </div>

            <button type="submit" class="btn btn-primary mr-2">Add to car</button>
            <a href="{{ url('/home') }}">
                <button type="button" class="btn btn-danger">Cancel</button>
            </a>
        </form>
    </div>
@endsection
