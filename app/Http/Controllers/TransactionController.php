<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

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
        if ($cart[$item->id] ?? false) {
            $cart[$item->id]['qty']++;
            $cart[$item->id]['subtotal'] = $item->price * $cart[$item->id]['qty'];
        } else {
            $cart[$item->id] = [
                'id' => $item->id,
                'name' => $item->name,
                'qty' => 1,
                'price' => $item->price,
                'subtotal' => $item->price
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
