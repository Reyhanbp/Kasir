<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $pagination = 5;

        $data = Category::where(function ($q) use ($request) {
            $q->where('name', 'LIKE', '%' . $request->search . '%');
        })->orderBy('id', 'asc')->paginate($pagination);
        return view('category.index', compact('data'));
    }
    public function Tambah()
    {
        return view('category.Add');
    }
    public function Edit($id)
    {
        $category = Category::find($id);
        return $category;
    }
    public function Update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('category')->with('message', 'Berhasil Memperbarui Data');

    }
    public function Delete($id)
    {
        Category::destroy($id);
        return redirect()->route('category')->with('message', 'Berhasil Menghapus Data');
    }
    public function Send(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('category')->with('message', 'Berhasil Menambahkan Data');

    }
}
