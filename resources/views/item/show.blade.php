@extends('layouts.app')

@section('content')
<div class="col-md-12 d-flex justify-content-center my-4">
    <div class="col-md-5">
        @if(session('errorStatus'))
            <div class="alert alert-danger"><i class="uil uil-times me-2"></i>{{session('errorStatus')}}</div>
        @endif
        <h1 class="fs-2 fw-bold">{{ $item->item_name }}</h1>
        <img src="{{asset('storage/images/'.$item->item_image)}}" class="w-100 rounded-3" >
        <div class="category mt-2 fs-5">
            Kategori : <span class="badge bg-primary mb-2"> {{ $item->kategori->nama_kategori }}</span>
        </div>
        <h1 class="fs-5 text-secondary">Rp. {{ number_format($item->item_price) }}</h1>
        <h1 class="fs-5 mt-2">
            Sisa Stok:
            @if($item->item_stock === '0' || $item->item_stock == null)
                <label for="" class="badge bg-danger">Out of Stock</label>
            @else
                {{ $item->item_stock }}
            @endif
        </h1>
        @guest
            <a href="{{ route('login') }}" class="btn btn-success btn-sm text-white fs-5">Pesan Sekarang</a>
        @else
            @if($item->item_stock === '0' || $item->item_stock == null)

            @else
                @if(Auth::user()->role == 'member')
                <div class="row mt-2 product_data">
                    <div class="col-md-3">
                        <input type="hidden" value ="{{$item->id}}" class="prod_id">
                        <label for="Quantity">Quantity</label>
                        <div class="input-group mb-3">
                            <button class ="input-group-text decrement-btn"> -</button>
                            <input type="text" class="form-control text-center qty-input" value="1" id="Quantity" name="Quantity">
                            <button class ="input-group-text increment-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <br>
                        <button type="button" class = "btn btn-primary third-color addToCart">Add to Cart</button>
                    </div>
                </div>
            @endif
            @endif
        @endguest
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
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
            $('.addToCart').click(function(){
                var prod_id = $(this).closest('.product_data').find('.prod_id').val();
                var qty = $(this).closest('.product_data').find('.qty-input').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: "POST",
                    url: "/cart",
                    data: {
                        prod_id: prod_id,
                        qty: qty,
                    },
                    success: function(response){
                        alert(response.success);
                    }
                });
            });
        });
    </script>
@endsection

