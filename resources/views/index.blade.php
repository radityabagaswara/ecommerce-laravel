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


        {{-- Brand Categories --}}
        <div class="home__category">
            <div class="item">
                <img src="https://static.bmdstatic.com/cs/assets/img/category-more.svg">
                <small>All Brands</small>
            </div>
            @foreach ($brands as $brand)
                <a>

                    <div class="item">
                        <img src="{{ $brand->image ?? 'https://static.bmdstatic.com/cs/assets/img/category-more.svg' }}">
                        <small>{{ $brand->name }}</small>
                    </div>
                    <a>

            @endforeach
        </div>

        {{-- Search --}}
        <div class="flex flex-row mt-5 gap-x-5 justify-around items-center relative">
            <input type="text" class="form-input rounded w-full" placeholder="Search Products" id="search_input">
            <div class="absolute top-12 left-0 z-40 w-full p-4 border border-gray-200 bg-white rounded hidden"
                id="search_container">
                <p id="search_loader">Loading</p>
                <ul id="search_list">
                </ul>
            </div>
        </div>
        {{-- For You --}}
        <div class="home__section">
            <div class="header">
                <h5>Made For You!</h5>
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
                    </a>
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
                <a>

                    <div class="item">
                        <img
                            src="{{ $category->image ?? 'https://static.bmdstatic.com/cs/assets/img/category-more.svg' }}">
                        <small>{{ $category->name }}</small>
                    </div>
                </a>

            @endforeach
        </div>

        {{-- For You --}}
        <div class="home__section">
            <div class="header">
                <h5>New On Display!</h5>
            </div>
            <div class="home__product_warpper">
                @foreach ($products as $product)
                    <a>

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
                    </a>

                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#search_input").on('input', function(event) {
            event.preventDefault();
            const searchTerms = $("#search_input").val();

            if (searchTerms.length < 3) return $("#search_container").addClass("hidden")
            $("#search_container").removeClass("hidden")

            $.ajax({
                type: 'POST',
                url: '{{ route('api.products.search') }}',
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    query: searchTerms
                },
                dataType: 'json',
                beforeSend: function() {
                    $('#search_loader').html("Loading...")
                },
                success: function(res) {
                    $('#search_list').html(' ');

                    if (res.data.products.length < 1)
                        $('#search_loader').html("0 Result(s) Found!")
                    else
                        $('#search_loader').html(`Showing ${res.data.products.length} Result(s)`)

                    res.data.products.forEach(e => {
                        $('#search_list').append(`
                            <li class="py-2 border-b border-gray-200">
                                <a href="{{ url('products/` + e.name + `') }}">
                                    <div class="grid grid-cols-12">
                                        <div class="col-span-12 md:col-span-1 max-h-12">
                                            <img class="md:w-full h-full object-contain"
                                                src="${e.image}">
                                        </div>
                                        <div class="col-span-12 md:col-span-9">
                                            <h6 class="text-sm">${e.name}</h6>
                                            <p><small>${e.brands.name} | ${e.categories.name}</small></p>

                                        </div>
                                        <div class="col-span-12 md:col-span-2">
                                            ${e.discount > 0 ? `<p class="text-sm"><span class="line-through">Rp ${e.sub_total}</span> <span class="text-red-500">-${e.discount}%</span></p>` : ``}
                                            <p class="text-sm text-indigo-500 font-semibold">Rp ${e.format_total}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        `)
                    })

                }
            })


        })
    </script>
@endsection
