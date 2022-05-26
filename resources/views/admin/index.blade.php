@extends('layouts.app')


@section('content')
<div class="container">
    <h1>Manage Barang</h1>
    @if (session('status'))
    <h6 class="alert alet-success">{{session('status')}}</h6>
    @endif
    <button type="button" class="btn btn-primary third-color"><a href="{{url('items')}}" class="text-decoration-none text-light">Tambah Barang</a> </button>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Item-Id</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Gambar</th>
            <th scope="col">Description</th>
            <th scope="col">Harga</th>
            <th scope="col">Stock</th>
            <th scope="col">Tipe Barang</th>
            <th scope="col">Option</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
          <tr>
                <th scope="row">ID-000{{$item->id}}</th>
                <td>{{$item->item_name}}</td>
                <td>
                    <img src="{{asset('storage/images/'.$item->item_image)}}" width="200px" height="auto" ></td>
                <td width="200px">{{$item->item_desc}}</td>
                <td>Rp {{$item->item_price}}</td>
                <td>{{$item->item_stock}}</td>
                <td>{{$item->kategori->nama_kategori}}</td>
                <td>
                    <button type="button" class="btn btn-primary third-color"><a href="{{url('items/update/'. $item->id)}}" class="text-decoration-none text-light" >Update</a> </button>
                    <button type="button" class="btn btn-danger">
                        <a href="#" class="text-white text-decoration-none" onclick="event.preventDefault();document.getElementById('delete-form-{{$item->id}}').submit();">
                            Delete
                            <form id="delete-form-{{$item->id}}" action="{{url('items/delete/'. $item->id)}}" method="POST" style="display:none";>
                                @csrf
                                @method('DELETE');
                            </form>
                        </a>
                    </button>
                </td>
          </tr>
        @endforeach
        </tbody>
      </table>
</div>
@endsection
