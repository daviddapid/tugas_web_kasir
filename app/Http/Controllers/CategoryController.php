<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
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
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories,name|max:255'
            ],
            [
                'required' => 'kolom :attribute tidak boleh kosong',
                'unique' => 'kategori ":input" sudah ada di database'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error-store', [
                'url' => route('category.store')
            ]);
        }

        Category::create([
            'name' => $request->name
        ]);

        return back()->with('success', 'Success menambah data 😊👌');
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
    public function edit(Category $category)
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|unique:categories,name|max:255'
            ],
            [
                'required' => 'kolom :attribute tidak boleh kosong',
                'unique' => 'kategori ":input" sudah ada di database'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error-update', [
                'url' => route('category.update', $category),
                'category_id' => $category->id
            ]);
        }

        $category->name = $request->name;
        $category->save();
        return back()->with('success', 'Sukses memperbarui data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Sukses menghapus data');
    }
}
