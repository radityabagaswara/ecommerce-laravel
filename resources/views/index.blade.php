@extends('layouts.user')

@section('title')
    BukaLaptop.com - All Your Laptop Problem!
@endsection

{{-- {{ dd($brands) }} --}}

@section('content')
    <div class="md:container md:px-4 md:mx-auto home__banner">
        <img src="https://static.bmdstatic.com/st/home/37bcf6-mb3.jpg">
    </div>
    <div class="container px-4 mx-auto">

        {{-- Search --}}
        <div class="flex flex-row mt-5 gap-x-5 justify-around items-center">
            <input type="text" class="form-input rounded-3xl w-11/12" placeholder="Search Products">
            <a class="btn btn-primary">Search</a>
        </div>

        {{-- Brand Categories --}}
        <div class="home__category">
            <div class="item">
                <img src="https://static.bmdstatic.com/cs/assets/img/category-more.svg">
                <small>All Brands</small>
            </div>
            @foreach ($brands as $brand)
                <div class="item">
                    <img src="{{ $brand->image ?? 'https://static.bmdstatic.com/cs/assets/img/category-more.svg' }}">
                    <small>{{ $brand->name }}</small>
                </div>
            @endforeach
        </div>

        {{-- For You --}}
        <div class="home__section">
            <div class="header">
                <h5>Made For You!</h5>
            </div>
            <div class="home__product_warpper">

                @foreach ($products as $product)
                    <div class="item">
                        @if ($product->discount > 0)
                            <div class="percentage">
                                <small>{{ $product->discount }}%</small>
                            </div>
                        @endif
                        <img src="{{ $product->image }}">
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

                @endforeach
            </div>
        </div>

        {{-- Categories --}}
        <div class="home__category">
            <div class="item">
                <img src="https://static.bmdstatic.com/cs/assets/img/category-more.svg">
                <small>All Categories</small>
            </div>

            @foreach ($categories as $category)
                <div class="item">
                    <img src="{{ $category->image ?? 'https://static.bmdstatic.com/cs/assets/img/category-more.svg' }}">
                    <small>{{ $category->name }}</small>
                </div>
            @endforeach
        </div>

        {{-- For You --}}
        <div class="home__section">
            <div class="header">
                <h5>New On Display!</h5>
            </div>
            <div class="home__product_warpper">
                @foreach ($products as $product)
                    <div class="item">
                        @if ($product->discount > 0)
                            <div class="percentage">
                                <small>{{ $product->discount }}%</small>
                            </div>
                        @endif
                        <img src="{{ $product->image }}">
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

                @endforeach
            </div>
        </div>
    </div>

@endsection
