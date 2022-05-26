<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartitems = Cart::where('kode_user', Auth::user()->kode_user)->get();
        return view('checkout\index',compact('cartitems'));
    }
    public function create(Request $request){
        $order = new Order();
        $order->kode_user = Auth::user()->kode_user;
        $order->kode_pos = $request->input('kode_pos1');
        $order->address = $request->input('address1');
        $order->random_code = rand(11111,99999);
        $total = 0;
        $cartitems_total = Cart::where('kode_user', Auth::user()->kode_user)->get();
        foreach($cartitems_total as $item){
            $total += $item->items->item_price * $item->jumlah;
        }
        $order->total_price = $total;
        $order->save();

        $order->id;
        $cartitems = Cart::where('kode_user', Auth::user()->kode_user)->get();
        foreach($cartitems as $item){
            OrderItems::create([
                'kode_pesanan' => $order->id,
                'kode_item' => $item->kode_produk,
                'jumlah' => $item->jumlah,
                'price' => $item->items->item_price,
            ]);
            $prod = Item::where('id', $item->kode_produk)->first();
            $prod->item_stock = $prod->item_stock - $item->jumlah;
            $prod->update();
        }
        $cartitems = Cart::where('kode_user', Auth::user()->kode_user)->get();
        Cart::destroy($cartitems);
        return redirect('/home')->with('status','Pesanan anda berhasil ditambahkan');
    }

    public function invoice(Request $request){
        $orders = Order::where('kode_user', Auth::user()->kode_user)->get();
        return view('checkout\invoice',compact('orders'));
    }

    public function admin_invoice(Request $request){
        $orders = Order::all();
        return view('admin.invoice',compact('orders'));
    }
    public function admin_update($id, Request $request){
        $orders = Order::findorfail($id);
        $orders->status = $request->input('proses');
        $orders->update();
        return redirect('/admin/invoice')->with('status','Pesanan berhasil diupdate');
    }
}
