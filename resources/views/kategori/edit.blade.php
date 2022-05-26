@extends('layouts.app')


@section('content')
<div class="container col-md-5"  >
    <div class="modal-header">
        <h5 class="modal-title" id="tambahKategoriLabel">Edit Kategori</h5>
    </div>
    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group mb-3">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"" placeholder="Masukkan nama kategori" name="nama_kategori" value="{{ $kategori->nama_kategori }}">
            @error('nama_kategori')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm text-white third-color">Update</button>
    </form>
</div>
@endsection
