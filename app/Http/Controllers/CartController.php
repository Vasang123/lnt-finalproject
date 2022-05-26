<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $product_id = $request->input('prod_id');
        $quantity_id = $request->input('qty');

        if(Auth::check()){
            $prod_check = Item::where('id', $product_id)->first();
            if($prod_check){
                if(Cart::where('kode_produk', $product_id)->where('kode_user', Auth::user()->kode_user)->exists()){
                    $cart = Cart::where('kode_produk', $product_id)->where('kode_user', Auth::user()->kode_user)->first();
                    $cart->jumlah = $cart->jumlah + $quantity_id;
                    $cart->save();
                    return response()->json(['success' => 'Item berhasil ditambahkan ke keranjang']);
                }else{
                    $cartItem = new Cart();
                    $cartItem->kode_user = Auth::user()->kode_user;
                    $cartItem->kode_produk = $product_id;
                    $cartItem->jumlah = $quantity_id;
                    $cartItem->save();
                    return response()->json(['success' => 'Item berhasil ditambahkan ke keranjang']);
                }
            }
        }else{
            return redirect('/login');
        }
    }
    public function show()
    {
        if(Auth::check()){
            $cart = Cart::where('kode_user', Auth::user()->kode_user)->get();
            // return response()->json($cart);
            return view('cart.showCart', compact('cart'));
        }else{
            return redirect('/login');
        }

    }

    public function destroy(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->input('item_id');
            if(Cart::where('kode_produk', $prod_id)->where('kode_user', Auth::user()->kode_user)->exists()){
                $cart = Cart::where('kode_produk', $prod_id)->where('kode_user', Auth::user()->kode_user)->first();
                $cart->delete();
                return response()->json(['success' => 'Item berhasil dihapus dari keranjang']);
            }else{
                return response()->json(['error' => 'Item tidak ditemukan']);
            }
        }else{
            return response()->json(['error' => 'Item gagal dihapus dari keranjang']);
        }
    }

    public function update(Request $request)
    {
        if(Auth::check()){
            $prod_id = $request->input('item_id');
            $quantity_id = $request->input('qty');
            if(Cart::where('kode_produk', $prod_id)->where('kode_user', Auth::user()->kode_user)->exists()){
                $cart = Cart::where('kode_produk', $prod_id)->where('kode_user', Auth::user()->kode_user)->first();
                $cart->jumlah = $quantity_id;
                $cart->update();
                return response()->json(['success' => 'Item berhasil diubah']);
            }else{
                return response()->json(['error' => 'Item tidak ditemukan']);
            }
        }else{
            return response()->json(['error' => 'Item gagal diubah']);
        }
    }
}
