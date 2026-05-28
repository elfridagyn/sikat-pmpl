<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::with('subCategories')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama_kategori' =>
            'required',

            'subkategori' =>
            'nullable'

        ]);

        Category::create([

            'nama_kategori' =>
            $request->nama_kategori,

            'subkategori' =>
            $request->subkategori

        ]);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan'
            );
    }
    public function edit(Category $category)
    {
        return view('categories.edit', [

            'category' => $category

        ]);
    }
    public function update(
        Request $request,
        Category $category
    ) {
        $request->validate([

            'nama_kategori' =>
            'required'

        ]);

        $category->update([

            'nama_kategori' =>
            $request->nama_kategori,

            'subkategori' =>
            $request->subkategori

        ]);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil diupdate'
            );
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil dihapus'
            );
    }
}
