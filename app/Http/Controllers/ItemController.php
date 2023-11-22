<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        $categories = Category::all();
        return view('item', compact('items', 'categories'));
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
        $rules = [
            'name' => 'required|max:255|unique:items,name',
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
        ];
        $messages = [
            'required' => 'kolom :attribute tidak boleh kosong',
            'unique' => 'produk ":input" sudah ada di database',
            'jul' => 'lontong'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error-store', [
                'url' => route('item.store'),
            ]);
        }

        Item::create($request->except('_token'));

        return back()->with('success', 'Sukses menambah data baru');
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
    public function edit(Item $item)
    {
        return $item;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        $rules = [
            'name' => 'required|max:255|unique:items,name,' . $item->id,
            'price' => 'required',
            'stock' => 'required',
            'category_id' => 'required',
        ];
        $messages = [
            'required' => 'kolom :attribute tidak boleh kosong',
            'unique' => 'produk ":input" sudah ada di database'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error-update', [
                'urlEdit' => route('item.edit', $item),
                'urlUpdate' => route('item.update', $item),
            ]);
        }

        $item->update($request->except(['_token', '_method']));
        return back()->with('success', 'Sukses menambah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return back()->with('success', 'Sukses menghapus data');
    }
}
