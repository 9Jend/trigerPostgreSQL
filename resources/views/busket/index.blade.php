@extends('layouts.app')

@section('content')
    <div class="container">
        @if (!$products->isEmpty())
            <div class="checkoutContainer">
                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    @method('patch')
                    <button class="btn btn-primary">Checkout</button>
                    <h2>Total price: <span id = 'order-price'>{{ $totalBusketPrice }}</span> $</h2>
                </form>
            </div>
        @endif
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-sm-6 mt-2">
                    <div class="card mb-30">
                        <div class="card-img-tiles">
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $product->title }}</h4>
                                <h6 class="card-title">{{ $product->category->title }}</h6>
                                <form action="{{ route('product.change', $product->id) }}"
                                    class="d-flex justify-content-between align-items-baseline">
                                    @csrf
                                    @method('patch')
                                    <p data-price="{{ $product->price }}" class="text-muted price">{{ $product->price }}
                                        $ </p>
                                    <input name='count' value="{{ $product->pivot->count }}" type="number"
                                        class="changeProductCount form-control m-2 w-25" min="1" max="10">
                                    <p data-total-price ='{{ $product->price * $product->pivot->count }}'
                                        class="text-muted total-price">{{ $product->price * $product->pivot->count }} $
                                    </p>
                                </form>
                                <form class="removeProductFromBusket" action="{{ route('product.remove', $product->id) }}"
                                    method="post">
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

        <h2 id="emptyList" class="@if (!$products->isEmpty()) visually-hidden @endif">
            Busket is empty
        </h2>
    </div>
@endsection
