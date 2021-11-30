<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                        {{-- <img src="https://static.bmdstatic.com/sf/assets/img/bhinneka-logo.svg" alt="Logo"
                            class="w-44"> --}}
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
                        {{-- <li class="pr-8">
                            <a class="">
                                Sign In
                            </a>
                        </li> --}}

                        @guest
                            <li>

                                <a class="btn btn-primary " href="{{ route('login') }}">Login</a>
                            </li>

                        @else

                            <li class="px-4">
                                <a class="nocolor">
                                    <i class="fas fa-shopping-cart fa-lg"></i>
                                </a>
                            </li>
                            <li class="px-4">
                                <a class="nocolor">
                                    <i class="fas fa-user fa-xl"></i>
                                    {{ explode(' ', Auth::user()->name)[0] }}
                                </a>
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
    </script>
</body>

</html>
