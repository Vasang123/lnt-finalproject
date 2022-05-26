<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();
        return view('kategori.index', compact('kategori'));
    }
    public function create()
    {
        return view('kategori.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'min:3|required|string'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('status', 'Kategori berhasil ditambah');
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'min:3|required|string'
        ]);
        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('status', 'Kategori berhasil diubah');
    }

    public function destroy($id){
        $kategori = Kategori::findOrFail($id);
        Storage::delete($kategori->nama_kategori);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('status', 'Kategori berhasil dihapus');
    }
}
