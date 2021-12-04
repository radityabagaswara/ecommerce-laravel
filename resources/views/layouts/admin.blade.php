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
                <small>Version 2.1b0.1</small>
            </div>
        </div>
    </div>

    <div class="sidebar min-h-screen w-64 fixed left-0 top-0 pt-20 border-r border-gray-300 bg-white" id="sidebar">
        <div class="px-5">
            <ul class="my-3">
                <li>
                    <i class="fas fa-home text-blue-400 mr-3"></i>
                    <a href="/">Home</a>
                </li>
            </ul>
            <ul class="my-3">
                <li>
                    <i class="fas fa-home text-blue-400 mr-3"></i>
                    <a href="/">Categories</a>
                </li>
            </ul>
            <ul class="my-3">
                <li>
                    <i class="fas fa-home text-blue-400 mr-3"></i>
                    <a href="/">Products</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="pt-24 content z-30 min-w-full" id="content">

        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $("#brg").on('click', function() {
            $("#sidebar").toggleClass('hide');
            $('#content').toggleClass('hide');
            // $('#listnav').toggleClass('hidden');
        })
    </script>

    @yield('script')
</body>

</html>
