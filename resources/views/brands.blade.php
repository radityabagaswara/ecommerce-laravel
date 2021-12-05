@extends('layouts.user')

@section('title')
    BukaLaptop.com - All Your Laptop Problem!
@endsection

@section('content')

    <div class="container px-4 mx-auto">
        <div class="home__section">
            <div class="header">
                <h5>{{ $brand->name }} Products!</h5>
            </div>
            <div class="home__product_warpper">

                @foreach ($products as $product)
                    <a href="{{ url('products/' . $product->name) }}">
                        <div class="item">
                            @if ($product->discount > 0)
                                <div class="percentage">
                                    <small>{{ $product->discount }}%</small>
                                </div>
                            @endif
                            <img src="{{ asset('/images/products/' . $product->image) }}">
                            <h6>{{ $product->name }}</h6>
                            @if ($product->discount > 0)
                                <small class="disc">Rp. {{ number_format($product->price) }}</small>
                                @guest
                                    <p>Rp {{ $product->formated_total }}</p>
                                @else
                                    <p>Rp {{ $product->format_total }}</p>
                                @endguest
                            @else
                                <small>&nbsp;</small>
                                @guest
                                    <p>Rp {{ $product->formated_total }}</p>
                                @else
                                    <p>Rp {{ $product->format_total }}</p>
                                @endguest

                            @endif

                        </div>
                    </a>
                @endforeach

            </div>
        </div>


    </div>



@endsection
