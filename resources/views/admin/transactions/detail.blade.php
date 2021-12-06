@extends('layouts.admin')


@section('title')
    Detail Transactions- BukaLaptop.com
@endsection

@section('content')

    <div class=" px-3">
        @if (session('status'))
            <div class="p-2 m-2 bg-green-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                role="alert">
                <span class="flex rounded-full bg-gray-600 uppercase px-2 py-1 text-xs font-bold mr-3">Success!</span>
                <span class="font-semibold mr-2 text-left flex-auto">Data Successfully Saved!</span>

            </div>
        @endif
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
                                {{ $transactions->confirmed ? 'Order Confirmed' : 'Order Need Confirmation' }}
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
                @if (!$transactions->confirmed)


                    <div class="mt-5">
                        <form method="post" action="{{ route('transactions.confirm') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $transactions->id }}" />
                            <button type="submit" class="btn btn-primary">Confirm Transactions</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
