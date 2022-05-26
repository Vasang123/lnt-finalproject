<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class ItemController extends Controller
{

    public function create(){
        $kategori = Kategori::get();
        return view('admin.create', compact('kategori'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'item_name' => 'required|max:255',
            'item_desc' => 'required',
            'item_price' => 'required|integer|min:1000',
            'item_stock' => 'required|min:1|max:999',
            'item_type' => 'required',
            'item_image' => 'required|image|file|max:10024',
        ]);
        $name = $request->file('item_image')->getClientOriginalName();
        $request->file('item_image')->storeAs('public/images', $name);
        Item::create([
            'item_name' => $request->item_name,
            'item_image' => $name,
            'item_desc' => $request->item_desc,
            'item_price' => $request->item_price,
            'item_stock' => $request->item_stock,
            'item_type' => $request->item_type,
        ]);
        return redirect('/admin')->with('status','Barang Berhasil Ditambahkan');
    }
    public function edit($id){
        $kategori = Kategori::get();
        $item = Item::findOrFail($id);
        return view('admin.update',  compact('item','kategori'));
    }

    public function update($id, Request $request){
        $validateData = $request->validate([
            'item_name' => 'required|max:255',
            'item_desc' => 'required',
            'item_price' => 'required|integer|min:1000',
            'item_stock' => 'required|min:1|max:999',
            'item_type' => 'required',
            'item_image' => 'required|image|file|max:10024',
        ]);
        $item =  Item::findOrFail($id);
        $image = '/storage/images/' . $item->item_image;
        $path = str_replace('\\', '/', public_path());
        unlink($path . $image);
        $name = $request->file('item_image')->getClientOriginalName();
        $request->file('item_image')->storeAs('public/images', $name);
        $item->update([
            'item_name' => $request->item_name,
            'item_image' => $name,
            'item_desc' => $request->item_desc,
            'item_price' => $request->item_price,
            'item_stock' => $request->item_stock,
            'item_type' => $request->item_type,
        ]);
        return redirect('/admin')->with('status','Barang Berhasil Diupdate');
    }

    public function destroy($id){
        $item = Item::findOrFail($id);
        $image = '/storage/images/' . $item->item_image;
        $path = str_replace('\\', '/', public_path());
        unlink($path . $image);
        Item::destroy($id);
        return redirect('/admin')->with('status','Barang Berhasil Dihapus');
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        $contents = Storage::get($item->item_image);
        return view('item.show', compact('item'), compact('contents'));
    }
}
