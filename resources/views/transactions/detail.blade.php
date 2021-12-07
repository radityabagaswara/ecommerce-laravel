@extends('layouts.user')

@section('title')
    Checkout - BukaLaptop.com
@endsection

@section('content')
    <div class="container px-4 mx-auto pb-24">
        <div class="card">
            <div class="card-header">
                <h6>Transactions #{{ $transactions->id }}</h6>
            </div>

            <div class="card-body">
                <div>
                    <dl class="grid grid-cols-12 my-1">
                        <dt class="col-span-4 md:col-span-2 font-semibold">Customer Name</dt>
                        <dd class="col-span-10">
                            {{ $transactions->Users->name }}
                        </dd>
                    </dl>

                    <dl class="grid grid-cols-12 my-1">
                        <dt class="col-span-4 md:col-span-2 font-semibold">Purchase Date</dt>
                        <dd class="col-span-10">
                            {{ $transactions->created_at }}
                        </dd>
                    </dl>
                    <dl class="grid grid-cols-12 my-1">
                        <dt class="col-span-4 md:col-span-2 font-semibold">Total Qty</dt>
                        <dd class="col-span-10">
                            {{ $transactions->qty }} Item/s
                        </dd>
                    </dl>
                    <dl class="grid grid-cols-12 my-1">
                        <dt class="col-span-4 md:col-span-2 font-semibold">Total</dt>
                        <dd class="col-span-10">
                            Rp {{ number_format($transactions->total) }}
                        </dd>
                    </dl>
                    <dl class="grid grid-cols-12 my-1">
                        <dt class="col-span-4 md:col-span-2 font-semibold">Status</dt>
                        <dd class="col-span-10">
                            <p class="{{ $transactions->confirmed ? 'text-green-400' : 'text-red-400' }}">
                                {{ $transactions->confirmed ? 'Order Confirmed' : 'Order Not Confirmed' }}
                            </p>
                        </dd>
                    </dl>
                </div>
                <div class="mt-5">
                    <h6>Item List</h6>
                    <ul>
                        @foreach ($transactions->Products as $pr)
                            <a href="{{ url('products/' . $pr->name) }}" target="_blank" rel="noreferrer">
                                <li class="grid grid-cols-12 py-3 border-b gap-x-5">
                                    <div class="col-span-1">
                                        <img class="w-full h-full object-contain"
                                            src="{{ asset('images/products/' . $pr->image) }}">
                                    </div>
                                    <div class="col-span-9">
                                        <h6 class="text-base">{{ $pr->name }}</h6>
                                        <small>Qty: {{ $pr->pivot->qty }}</small>
                                        @if ($pr['discount'])
                                            <p><small>
                                                    <span class="line-through ">
                                                        Rp
                                                        {{ number_format($pr->pivot->price) }}</span> <span
                                                        class="text-red-500">{{ $pr->pivot->discount }}%</span>
                                                </small>
                                            </p>
                                            <p class="text-indigo-500 font-semibold">
                                                Rp
                                                {{ number_format($pr->pivot->total) }}
                                            </p>
                                        @else
                                            <p class="text-indigo-500 font-semibold">
                                                Rp
                                                {{ number_format($pr->pivot->price) }}
                                            </p>
                                        @endif
                                    </div>
                                </li>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
