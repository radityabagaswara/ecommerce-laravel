@extends('layouts.user')

@section('title')
    {{ $product->name }} - BukaLaptop.com
@endsection

@section('content')
    <div class="container px-4 mx-auto">

        <div class="grid grid-cols-12 md:gap-x-5">
            <div class="col-span-12 md:col-span-5 my-3 md:my-0 border border-gray-200 p-5">
                <img class="w-full max-h-96 object-contain" src="{{ $product->image }}">
            </div>

            <div class="col-span-12 md:col-span-7 my-3 md:my-0">
                <div class="border-b border-gray-200 pb-3">
                    <h4>{{ $product->name }}</h4>
                    <small><a>{{ $product_brand->name }}</a> | <a>{{ $product_category->name }}</a></small>
                </div>
                <div class="mt-5">
                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Price</dt>
                        <dd class="col-span-8">

                            @if ($product->discount > 0)
                                <small class="text-gray-600 line-through">Rp. {{ number_format($product->price) }}</small>
                                @guest
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->formated_total }}</p>
                                @else
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->format_total }}</p>
                                @endguest
                            @else
                                @guest
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->formated_total }}</p>
                                @else
                                    <p class="text-indigo-500 font-semibold">Rp {{ $product->format_total }}</p>
                                @endguest

                            @endif
                        </dd>
                    </dl>

                    <dl class="grid grid-cols-12 my-1">
                        <dt class="col-span-4 font-semibold">Category</dt>
                        <dd class="col-span-8">
                            {{ $product_category->name }}
                            <p><a href=""><small>More from this Category</small></a></p>

                        </dd>
                    </dl>

                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Brand</dt>
                        <dd class="col-span-8">
                            {{ $product_brand->name }}
                            <p><a href=""><small>More from this brand</small></a></p>
                        </dd>
                    </dl>

                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Model</dt>
                        <dd class="col-span-8">
                            {{ $product->model }}
                        </dd>
                    </dl>


                    <dl class="grid grid-cols-12 my-2">
                        <dt class="col-span-4 font-semibold">Screen</dt>
                        <dd class="col-span-8">
                            {{ $product->screen_size }} Inches
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

    </div>

@endsection
