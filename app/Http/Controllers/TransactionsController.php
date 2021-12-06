<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Models\TransactionsProducts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function adminIndex()
    {
        $transactions = Transactions::all();

        foreach ($transactions as $transaction) {
            $total = 0;
            $qty = 0;
            foreach ($transaction->Products as $pr) {
                $total += $pr->pivot->total;
                $qty += $pr->pivot->qty;
            }
            $transaction['total'] = $total;
            $transaction['qty'] = $qty;
        }

        return view('admin.transactions.index', compact('transactions'));
    }

    public function confirmTransaction(Request $request)
    {
        $transaction = Transactions::find($request->get('id'));

        $transaction->confirmed = true;
        $transaction->save();

        return redirect()->back()->with('status', 'Transaction has been confirmed');
    }


    public function adminDetail($id)
    {
        $transactions = Transactions::find($id);

        $total = 0;
        $qty = 0;
        foreach ($transactions->Products as $pr) {
            $total += $pr->pivot->total;
            $qty += $pr->pivot->qty;
        }
        $transactions['total'] = $total;
        $transactions['qty'] = $qty;

        return view('admin.transactions.detail', compact('transactions'));
    }

    public function checkoutIndex()
    {
        $carts = session('cart');
        $total = 0;
        foreach ($carts as $id => $cart) {
            $total += $cart['total'];
        }

        return view('checkout', compact('carts', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tr = new Transactions();
        $users_id = Auth::user()->id;

        $tr->users_id = $users_id;
        $tr->save();

        $last_id = $tr->id;

        $carts = session('cart');

        foreach ($carts as $id => $cart) {
            $cr = new TransactionsProducts();
            $cr->qty = $cart['qty'];
            $cr->discount = $cart['disc'];
            $cr->total = $cart['total'];
            $cr->price = $cart['price'];
            $cr->products_id = $cart['id'];
            $cr->transactions_id = $last_id;
            $cr->save();
        }


        session()->forget('cart');



        return redirect('/')->with('status', 'Successfully Checkout!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(Transactions $transactions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(Transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transactions $transactions)
    {
        //
    }
}
