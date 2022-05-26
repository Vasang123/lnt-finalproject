@extends('layouts.app')


@section('content')
<div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <h6 class="alert alet-success">{{session('status')}}</h6>
                @endif
                <div class="card-header">
                    <h4>Tambah Barang</h4>
                </div>
                <div class="card-body">
                    <form action="{{url('/items/update/'. $item->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="item_name" class="col-md-4 col-form-label text-md-end">{{ __('Nama Barang') }}</label>

                            <div class="col-md-6">
                                <input id="item_name" type="text" class="form-control @error('item_name') is-invalid @enderror" name="item_name" value="{{ $item->item_name }}" required autocomplete="item_name" autofocus>

                                @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item_image" class="col-md-4 col-form-label text-md-end">{{ __('Upload Gambar') }}</label>

                            <div class="col-md-6">
                                <input id="item_image" type="file" class="form-control @error('item_image') is-invalid @enderror" name="item_image"  required autofocus>

                                @error('item_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item_desc" class="col-md-4 col-form-label text-md-end">{{ __('Deskripsi Barang') }}</label>
                            <div class="form-floating col-md-6">
                                <textarea id="item_desc"class="form-control"  @error('item_desc') is-invalid @enderror" name="item_desc" value="item_desc" required  autofocus>{{ $item->item_desc }}</textarea>
                                <label for="floatingTextarea">Description</label>
                                @error('item_desc')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                              </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item_price" class="col-md-4 col-form-label text-md-end">{{ __('Harga Barang') }}</label>

                            <div class="col-md-6">
                                <input id="item_price" type="number" class="form-control @error('item_price') is-invalid @enderror" name="item_price" value="{{ $item->item_price }}" required autocomplete="item_price" autofocus>

                                @error('item_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item_stock" class="col-md-4 col-form-label text-md-end">{{ __('Stock Barang') }}</label>

                            <div class="col-md-6">
                                <input id="item_stock" type="number" class="form-control @error('item_stock') is-invalid @enderror" name="item_stock" value="{{ $item->item_stock }}" required autocomplete="item_stock" autofocus>

                                @error('item_stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="item_type" class="col-md-4 col-form-label text-md-end">{{ __('Tipe Barang') }}</label>
                            <div class="form-floating col-md-6">
                                <select name="item_type" class=" form-select form-control @error('item_type') is-invalid @enderror" name="item_type" required autocomplete="item_type" autofocus>
                                    @foreach($kategori as $category)
                                    <option value="{{ $category->id}}">{{ $category->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                <label for="floatingSelect">Choose One Category</label>
                            </div>
                            @error('item_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary third-color">
                                    {{ __('Tambah') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
