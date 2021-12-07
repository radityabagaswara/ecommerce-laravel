@extends('layouts.user')

@section('title')
    Checkout - BukaLaptop.com
@endsection

@section('content')
    <div class="container px-4 mx-auto">
        @if (session('status'))
            <div class="p-2 m-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-gray-600 uppercase px-2 py-1 text-xs font-bold mr-3">Success!</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('status') }}</span>

            </div>
        @endif
        <div class="home__section">
            <div class="header">
                <h6>Purchase History</h6>
            </div>
            <div class="">
                <ul>
                    <li class="grid grid-cols-12 gap-x-5 py-3 border-b border-gray-200">
                        <div class="col-span-1">
                            ID
                        </div>

                        <div class="col-span-3">
                            Items/Grand Total
                        </div>

                        <div class="col-span-3">
                            Date
                        </div>
                        <div class="col-span-3">
                            Status
                        </div>
                        <div class="col-span-2"></div>

                    </li>
                    @foreach ($transactions as $tr)
                        <li class="grid grid-cols-12 gap-x-5 py-5 border-b border-gray-200">
                            <div class="col-span-1">
                                #{{ $tr->id }}
                            </div>

                            <div class="col-span-3">
                                {{ $tr->qty }} Items (Rp {{ number_format($tr->total) }})
                            </div>
                            <div class="col-span-3">
                                {{ $tr->created_at }}
                            </div>
                            <div class="col-span-3">
                                <p class="font-semibold {{ $tr->confirmed ? 'text-green-400' : 'text-red-400' }}">
                                    {{ $tr->confirmed ? 'Confirmed' : 'Not Confimed' }}
                                </p>
                            </div>

                            <div class="col-span-2">
                                <a class="btn btn-primary" href="{{ url('transactions/' . $tr->id) }}">Detail</a>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@endsection
