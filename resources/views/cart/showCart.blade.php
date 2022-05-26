@extends('layouts.app')

@section('content')
    <div class="container my-1 col-md-8">
        @if ($cart->count() > 0)
            <table class="table table-striped ">
                <thead>
                    <tr>
                    <th scope="col"> <h5 class="fw-bold">Gambar</h5> </th>
                    <th scope="col"> <h5 class="fw-bold">Nama Barang</h5> </th>
                    <th scope="col"> <h5 class="fw-bold">Harga</h5> </th>
                    <th scope="col"> <h5 class="fw-bold">Jumlah Barang</h5> </th>
                    <th scope="col"> <h5 class="fw-bold">Option</h5> </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($cart as $item)
                        <tr>
                            <td> <img src="{{asset('storage/images/'.$item->items->item_image)}}" class="img-fluid" alt="Item Image" style="width:200px "></td>
                            <td><h5>{{$item->items->item_name}}</h5></td>
                            <td>Rp {{$item->items->item_price}}</td>
                            <td>
                                @if ($item->items->item_stock > $item->jumlah)
                                    <input type="hidden" value ="{{$item->kode_produk}}" class="prod_id">
                                    <div class="input-group mb-3" style="width : 140px">
                                        <button class ="input-group-text decrement-btn changeQuantity"> -</button>
                                        <input type="text" class="form-control text-center qty-input" value="{{$item->jumlah}}" id="Quantity" name="Quantity">
                                        <button class ="input-group-text increment-btn changeQuantity">+</button>
                                    </div>
                                @endif
                            </td>
                            <td><button class="btn btn-danger delete-cart-item"><i class="uil uil-trash-alt"></i> Remove</button></td>
                        </tr>
                        @php
                            $total += $item->items->item_price * $item->jumlah;
                        @endphp
                    @endforeach
                    <tr>
                    <td><h5 class="fw-bold mt-3">Total Price : Rp {{$total}}</h5></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-success third-color"> <a href="{{url('/checkout')}}"class="text-decoration-none text-white" >Checkout</a> </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <div class="alert alert-warning" role="alert">
                Keranjang Anda Kosong :(
            </div>
            <button class="btn btn-primary third-color"> <a href="{{url('home')}}" class="text-decoration-none text-white">Lanjut Belanja</a>  </button>
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        $('.increment-btn').click(function(){
                var currentVal = parseInt($(this).prev().val());
                if (!isNaN(currentVal)) {
                    $(this).prev().val(currentVal + 1);
                }
            });
        $('.decrement-btn').click(function(){
            var currentVal = parseInt($(this).next().val());
            if (!isNaN(currentVal) && currentVal > 1) {
                $(this).next().val(currentVal - 1);
            }
        });
        $('.delete-cart-item').click(function(){
            var item_id = $(this).closest('tr').find('.prod_id').val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                url: "/cart/delete",
                method: 'POST',
                data: {
                    item_id: item_id
                },
                success: function(response){
                    if(response.success){
                        alert(response.success);
                        location.reload();
                    }else{
                        alert(response.error);
                    }
                }
            });

        });
        $('.changeQuantity').click(function(e){
            e.preventDefault();
            var item_id = $(this).closest('tr').find('.prod_id').val();
            var qty = $(this).closest('tr').find('.qty-input').val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });

            $.ajax({
                url: "/cart/changeQuantity",
                method: 'POST',
                data: {
                    item_id: item_id,
                    qty: qty
                },
                success: function(response){
                    window.location.reload();
                }
            });

        });
    </script>
@endsection
