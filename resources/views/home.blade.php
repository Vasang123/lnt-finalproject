@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
</div>
<div class="container mt-3">
    <div class="row">
        @foreach ($items as $item)
        <div class="col-xl-3 col-6 mb-3">
            <div class="col-md-12 shadow-sm">
                <img src="{{asset('storage/images/'.$item->item_image)}}" class="w-100 rounded-3" >
                <div class="card-body">
                    <h5 class="card-title rounded-3 fw-bold"> {{ $item->item_name }}</h5>
                    <p class="card-text">Rp. {{ number_format($item->item_price) }}</p>
                    <p class="card-text">
                        Stok:
                        @if($item->item_stock === '0' || $item->item_stock == null)
                            <span class="text-danger">Barang Kosong</span>
                        @else
                            {{ $item->item_stock }}
                        @endif
                    </p>
                    <a href="{{ route('showItems', $item->id) }}" class="btn btn-primary text-white w-100 third-color">Lihat <i class="uil uil-eye ms-1"></i></a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
