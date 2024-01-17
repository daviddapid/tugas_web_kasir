<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $grandtotal = 0;
        if (session('cart')) {
            foreach (session('cart') as $item) {
                $grandtotal += $item['qty'] * $item['price'];
            }
        }
        return view('transaction', compact('items', 'grandtotal'));
    }

    public function addToCart(Item $item)
    {
        $cart = session('cart');
        if ($item->stock <= 0) {
            return back()->with('failed', 'Stok barang ' . $item->name . ' tidak mencukupi');
        }
        if ($cart[$item->id] ?? false) {
            $cart[$item->id]['qty']++;
            $cart[$item->id]['subtotal'] = $item->price * $cart[$item->id]['qty'];
        } else {
            $cart[$item->id] = [
                ...$item->only('id', 'name', 'price', 'stock'),
                'qty' => 1,
                'subtotal' => $item->price,
            ];
        }

        session()->put('cart', $cart);

        return back();
    }
    function updateCart(Request $request, Item $item)
    {
        $cart = session('cart');
        $cart[$item->id]['qty'] = $request['qty-' . $item->id];
        $cart[$item->id]['subtotal'] = $item->price * $cart[$item->id]['qty'];

        session()->put('cart', $cart);

        return back();
    }
    function deleteItem(Item $item)
    {
        $cart = session('cart');
        unset($cart[$item->id]);
        session()->put('cart', $cart);
        return back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $t = Transaction::create([
            ...$request->only('total', 'pay_total'),
            'user_id' => Auth::user()->id,
            'date' => Carbon::now()
        ]);

        $cart = session()->get('cart');
        foreach ($cart as $item) {
            TransactionDetail::create([
                'transaction_id' => $t->id,
                'item_id' => $item['id'],
                'qty' => $item['qty'],
                'subtotal' => $item['subtotal']
            ]);

            $itemDb = Item::find($item['id']);
            $itemDb->stock -= $item['qty'];
            $itemDb->save();
        }
        session()->forget('cart');
        DB::commit();

        return redirect()->route('transaction.show', $t);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('invoice', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    function reset()
    {
        session()->forget('cart');
    }
}
