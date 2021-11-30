@extends('layouts.user')

@section('title')
    Create Account - BukaLaptop.com
@endsection

@section('content')
    <div class="container mx-auto  px-4">
        <div class="flex flex-col items-center justify-center">
            <div class="text-center mb-5">
                <h4 class="text-primary">Welcome!</h4>
                <small>Please enter your details below to continue</small>
            </div>
            <div class="w-full max-w-lg">
                <div class="flex flex-col break-words bg-white border border-gray-200    rounded ">
                    <form class="w-full p-6" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">
                                Full Name
                            </label>

                            <input id="name" type="text" class="form-input w-full @error('name')  border-red-500 @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                Email
                            </label>

                            <input id="email" type="email"
                                class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

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
                                required autocomplete="new-password">

                            @error('password')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Confirm Password') }}:
                            </label>

                            <input id="password-confirm" type="password" class="form-input w-full"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="flex flex-col items-center w-full">
                            <button type="submit" class="btn btn-primary w-full">
                                Register
                            </button>

                            <div class="py-5 w-full">
                                <h6 class="w-full text-center border-b mt-3 mx-0 mb-5 font-normal text-sm "
                                    style="line-height:0.1em;"><span class="bg-white py-0 px-5">Already Have an
                                        Account?</span>
                                </h6>
                            </div>
                            <a class="btn btn-secondary w-full" href="{{ route('login') }}">Login</a>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
