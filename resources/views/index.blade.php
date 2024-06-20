@extends('layouts.app')

@section('content')

@if (\Session::has('success'))
    <script>
        alert('Order checkout success')
    </script>
@endif
    <div class="container">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-sm-6 mt-2">
                    <div class="card mb-30">
                        <div class="card-img-tiles">
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $product->title }}</h4>
                                <h6 class="card-title"> Category: {{ $product->category->title }}</h6>
                                <p class="text-muted">{{ $product->price }} $ </p>
                                <form class=" @if (in_array($product->id, $productBusketIDs)) visually-hidden @endif addToBasket"
                                    action="{{ route('product.add', $product->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button class="btn btn-outline-primary btn-sm" data-abc="true">Add to busket</button>
                                </form>
                                <form class=" @if (!in_array($product->id, $productBusketIDs)) visually-hidden @endif removeFromBusket"
                                    action="{{ route('product.remove', $product->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <button class="btn btn-outline-primary btn-sm" data-abc="true">Remove from
                                        busket</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
