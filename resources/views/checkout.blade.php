@extends('layouts.user')

@section('title')
    Checkout - BukaLaptop.com
@endsection

@section('content')
    <div class="container px-4 mx-auto">
        @if (session('status'))
            <div class="p-2 m-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-gray-600 uppercase px-2 py-1 text-xs font-bold mr-3">Success!</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('status') }}</span>

            </div>
        @endif
        <div class="home__section">
            <div class="header">
                <h6>Cart</h6>
            </div>
            <div class="">
                <ul>
                    @foreach ($carts as $id => $cart)

                        <li class="grid grid-cols-12 py-3 border-b gap-x-5">
                            <div class="col-span-1">
                                <img class="w-full h-full object-contain"
                                    src="{{ asset('images/products/' . $cart['image']) }}">
                            </div>
                            <div class="col-span-9">
                                <h6 class="text-base">{{ $cart['name'] }}</h6>
                                <small>Qty: {{ $cart['qty'] }}</small>
                                @if ($cart['disc'])
                                    <p><small class="line-through ">
                                            Rp
                                            {{ number_format($cart['price'] * $cart['qty']) }}
                                        </small>
                                    </p>
                                    <p class="text-indigo-500 font-semibold">
                                        Rp
                                        {{ number_format(($cart['price'] - ($cart['disc'] / 100) * $cart['price']) * $cart['qty']) }}
                                    </p>
                                @else
                                    <p class="text-indigo-500 font-semibold">
                                        Rp
                                        {{ number_format($cart['price']) }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-span-2 flex flex-row items-center gap-x-5">
                                <a class="btn btn-primary" href="{{ url('products/' . $cart['name']) }}">Update</a>
                                <form method="post" action="{{ route('cart.delete') }}">
                                    @csrf
                                    <input type='hidden' name="product_id" value="{{ $cart['id'] }}">
                                    <button class="btn btn-icon btn-danger" type="submit"><i
                                            class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="py-5">
                <h6>Details</h6>
                <p>Total: Rp {{ number_format($total) }}</p>
                <form method="post" action="{{ route('checkout.store') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Purchase</button>
                </form>
            </div>
        </div>

    </div>
@endsection
