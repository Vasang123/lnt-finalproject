<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Item::all();
        return view('home',compact('items'));
    }
    public function admin()
    {
        $kategori = Kategori::all();
        $items = Item::all();
        return view('admin.index',compact('items', 'kategori'));
    }
    public function member()
    {
        return view('member.index');
    }
}
