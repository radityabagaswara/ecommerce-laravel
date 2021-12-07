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

    @yield('imports')
</head>

<body class='admin'>
    <div class="w-full fixed z-50 bg-white dark:bg-gray-900 border dark:border-gray-700 h-16">
        <div class="flex min-w-full h-full items-center justify-between container px-4">
            <div class="flex items-center">
                <button class="block lg:hidden btn btn-ham" id="brg">
                    <i class="fas fa-align-justify text-gray-700 dark:text-gray-300"></i>
                </button>
                <div class="ml-3 hidden md:block">
                    <a href="/admin" style="color: unset;">
                        <h6>
                            BukaLaptop.com
                        </h6>
                    </a>
                </div>
            </div>
            <div>
                <ul class="flex flex-row gap-x-3">
                    <li class="relative">
                        <a class="nocolor" onclick="openUser()">
                            <i class="fas fa-user fa-xl"></i>
                            {{ explode(' ', Auth::user()->name)[0] }}
                        </a>
                        <div class="absolute top-8 right-0 p-4 bg-white rounded border border-gray-200 hidden"
                            id="user">
                            <ul class="flex flex-col gap-y-1">
                                <a href="{{ url('/') }}">
                                    <li class="flex flex-row gap-x-3 items-center">
                                        <i class="fas fa-home"></i>
                                        <p>Homepage</p>
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
                </ul>
            </div>
        </div>
    </div>

    <div class="sidebar min-h-screen w-64 fixed left-0 top-0 pt-20 border-r border-gray-300 bg-white" id="sidebar">
        <div class="px-5">
            <ul class="my-3">
                <li class="flex flex-row flex-nowrap items-center justify-start gap-x-3 my-4">
                    <i class="fas fa-home text-blue-400 w-10"></i>
                    <a href="{{ url('admin') }}">Home</a>
                </li>
            </ul>
            <ul class="my-3">
                <li class="flex flex-row flex-nowrap items-center justify-start gap-x-3 my-4">
                    <i class="fas fa-laptop text-red-400 w-10"></i>
                    <a href="{{ url('admin/categories') }}">Categories</a>
                </li>
            </ul>
            <ul class="my-3">
                <li class="flex flex-row flex-nowrap items-center justify-start gap-x-3 my-4">
                    <i class="fas fa-box text-yellow-400 w-10"></i>
                    <a href="{{ url('admin/products') }}">Products</a>
                </li>
            </ul>
            <ul class="my-3">
                <li class="flex flex-row flex-nowrap items-center justify-start gap-x-3 my-4">
                    <i class="fab fa-apple text-green-400 w-10"></i>
                    <a href="{{ url('admin/brands') }}">Brands</a>
                </li>
            </ul>
            <ul class="my-3">
                <li class="flex flex-row flex-nowrap items-center justify-start gap-x-3 my-4">
                    <i class="fas fa-dollar-sign text-indigo-400 w-10"></i>
                    <a href="{{ url('admin/transactions') }}">Transactions</a>
                </li>
            </ul>
            @can('isAdmin')
                <ul class="my-3">
                    <li class="flex flex-row flex-nowrap items-center justify-start gap-x-3 my-4">
                        <i class="fas fa-user-shield text-pink-400 w-10"></i>
                        <a href="{{ url('admin/staff') }}">Staffs</a>
                    </li>
                </ul>
            @endcan

        </div>
    </div>

    <div class="pt-24 content z-30 " id="content">

        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $("#brg").on('click', function() {
            $("#sidebar").toggleClass('hide');
            $('#content').toggleClass('hide');
            // $('#listnav').toggleClass('hidden');
        })

        function openUser() {
            $("#user").toggleClass('hidden');
        }
    </script>

    @yield('script')
</body>

</html>
