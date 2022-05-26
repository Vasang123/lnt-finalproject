@extends('layouts.app')


@section('content')
<div class="container col-md-5"  >
    <div class="modal-header">
        <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori</h5>
    </div>
    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"" placeholder="Masukkan nama kategori" name="nama_kategori" value="{{ old('nama_kategori') }}">
            @error('nama_kategori')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-sm text-white third-color">Submit</button>
    </form>
</div>
@endsection
