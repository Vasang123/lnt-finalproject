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
                                        <td> Rp {{number_format($item->items->item_price * $item->jumlah)}}</td>
                                    </tr>
                                    @php
                                        $total += $item->items->item_price * $item->jumlah;
                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td class="fw-bold">Total Price : Rp {{number_format($total)}}</td>
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
                                    <label for="address1">Address</label>
                                    <input type="text" class="form-control  @error('address1') is-invalid @enderror" id="address1" name="address1"  name="address1" value="{{ old('address1') }}" required autocomplete="address1" autofocus>
                                    @error('address1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="cold-md-8 mt-2">
                                    <label for="kode_pos1">Kode Pos</label>
                                    <input type="text" class="form-control @error('kode_pos1') is-invalid @enderror" id="kode_pos1" name="kode_pos1"   name="kode_pos1" value="{{ old('kode_pos1') }}" autocomplete="kode_pos1" autofocus required>
                                    @error('kode_pos1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
