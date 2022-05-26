@extends('layouts.app')


@section('content')
    <div class="container mt-3">
        <form action="{{url('create-order')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="card secon-color">
                        <div class="card-body">
                            <h5>Order Details</h5>
                            <hr>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Jumlah Barang</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cartitems as $item)
                                    <tr>
                                        <td> {{$item->items->item_name}}</td>
                                        <td> {{$item->jumlah}}</td>
                                        <td> Rp {{$item->items->item_price}}</td>
                                    </tr>
                                    @php
                                        $total += $item->items->item_price * $item->jumlah;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td class="fw-bold">Total Price : Rp {{$total}}</td>
                                        <td></td>
                                        <td></td>
                                     </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="card secon-color">
                        <div class="card-body">
                            <h5>Shipment Details</h5>
                            <hr>
                            <div class="row">
                                <div class="cold-md-8">
                                    <label for="fist">Address</label>
                                    <input type="text" class="form-control " id="address" name="address1">
                                </div>
                                <div class="cold-md-8 mt-2">
                                    <label for="fist">Kode Pos</label>
                                    <input type="text" class="form-control " id="kode_pos" name="kode_pos1">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary third-color mt-4"> Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
