<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="header fixed z-50 w-full bg-white shadow">
        <div class="container flex justify-between items-center p-4 px-4 mx-auto">
            <div class="w-1/2 md:w-1/6">
                <div class="flex">
                    <a href={{ url('/') }} class="nocolor nohover">
                        <h4>BukaLaptop</h4>
                    </a>
                </div>
            </div>
            <div>
                <button class="md:hidden pr-4" id="burger">
                    <img src="https://img.icons8.com/android/24/000000/menu.png" />
                </button>
                <div class="hidden md:block absolute md:relative left-0" id="listnav">
                    <ul
                        class="flex flex-col items-start md:items-center md:flex-row gap-y-5 md:gap-y-0 p-4 md:p-0 px-6 md:px-0 mt-4 md:mt-0 w-screen md:w-full bg-white">

                        @guest
                            <li>
                                <a class="btn btn-primary " href="{{ route('login') }}">Login</a>
                            </li>

                        @else
                            <li class="px-4">
                                <a class="nocolor" href="{{ url('compare') }}">
                                    <i class="fas fa-not-equal fa-lg"></i>
                                    Compare
                                </a>
                            </li>
                            <li class="px-4">
                                <div class="w-full">
                                    <a class="nocolor" onclick="openCart()">
                                        <i class="fas fa-shopping-cart fa-lg"></i>
                                        Cart
                                    </a>
                                    <div class="absolute top-8 left-0 p-3 bg-white rounded border border-gray-200 hidden"
                                        id="cart_details" style="min-width: 300px;">
                                        <h6>Your Cart</h6>
                                        @if (session('cart'))
                                            <ul>
                                                @foreach (session('cart') as $id => $details)
                                                    <a href="{{ url('products/' . $details['name']) }}">
                                                        <li class="py-2 border-b border-gray-200 flex flex-row gap-x-3">
                                                            <div class="w-3/12">
                                                                <img class="h-full object-contain"
                                                                    src="{{ asset('images/products/' . $details['image']) }}">
                                                            </div>
                                                            <div>

                                                                <h6 class="text-sm">{{ $details['name'] }}</h6>
                                                                <div class="">
                                                                    <small>Qty: {{ $details['qty'] }}</small>
                                                                    @if ($details['disc'])
                                                                        <p><small class="line-through ">
                                                                                Rp
                                                                                {{ number_format($details['price'] * $details['qty']) }}
                                                                            </small>
                                                                        </p>
                                                                        <p class="text-indigo-500 font-semibold">
                                                                            Rp
                                                                            {{ number_format(($details['price'] - ($details['disc'] / 100) * $details['price']) * $details['qty']) }}
                                                                        </p>
                                                                    @else
                                                                        <p class="text-indigo-500 font-semibold">
                                                                            Rp
                                                                            {{ number_format($details['price']) }}
                                                                        </p>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </a>
                                                @endforeach
                                            </ul>
                                            <div class="mt-5">
                                                <a class="btn btn-secondary" href="{{ url('/checkout') }}">View Cart</a>
                                            </div>
                                        @else
                                            <p>Cart is empty</p>
                                        @endif

                                    </div>
                                </div>
                            </li>
                            <li class="px-4">
                                <a class="nocolor" onclick="openUser()">
                                    <i class="fas fa-user fa-xl"></i>
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </a>
                                <div class="absolute top-8 left-0 p-4 bg-white rounded border border-gray-200 hidden"
                                    id="user">
                                    <ul class="flex flex-col gap-y-1">
                                        <a href="{{ route('transactions.home') }}">
                                            <li class="flex flex-row gap-x-3 items-center">
                                                <i class="fas fa-history"></i>
                                                <p>Purchase History</p>
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="flex flex-row gap-x-3 items-center">
                                                <i class="fas fa-sign-out-alt"></i>
                                                <a href="{{ route('logout') }}" class=""
                                                    onclick="event.preventDefault();
                                                                                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="hidden">
                                                    {{ csrf_field() }}
                                                </form>
                                            </li>
                                        </a>
                                    </ul>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="pt-24">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $("#burger").on('click', function() {
            $('#listnav').toggleClass('hidden');
        })

        function openCart() {
            $("#cart_details").toggleClass('hidden');
        }

        function openUser() {
            $("#user").toggleClass('hidden');
        }
    </script>

    @yield('script')
</body>

</html>
