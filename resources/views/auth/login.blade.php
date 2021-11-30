@extends('layouts.user')
@section('title')
    Sign in to your account - BukaLaptop.com
@endsection

@section('content')
    <div class="container mx-auto  px-4">
        <div class="flex flex-col items-center justify-center">
            <div class="text-center mb-5">
                <h4 class="text-primary">Welcome Back!</h4>
                <small>Please enter your email and password</small>
            </div>
            <div class="w-full max-w-lg">
                <div class="flex flex-col break-words bg-white border border-gray-200    rounded ">

                    <form class="w-full p-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                Email
                            </label>

                            <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                                Password
                            </label>

                            <input id="password" type="password"
                                class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                                required>

                            @error('password')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                            @if (Route::has('password.request'))
                                <a class="py-1 text-sm whitespace-no-wrap no-underline"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>


                        <div class="flex flex-col items-center w-full">
                            <button type="submit" class="btn btn-primary w-full">
                                Sign In
                            </button>

                            <div class="py-5 w-full">
                                <h6 class="w-full text-center border-b mt-3 mx-0 mb-5 font-normal text-sm "
                                    style="line-height:0.1em;"><span class="bg-white py-0 px-5">Don't Have an
                                        Account?</span>
                                </h6>
                            </div>
                            @if (Route::has('register'))
                                <a class="btn btn-secondary w-full" href="{{ route('register') }}">Register</a>


                            @endif

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
