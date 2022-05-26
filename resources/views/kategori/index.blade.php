@extends('layouts.app')


@section('content')
<div class="container col-md-7">
    <h1>Manage Kategori</h1>
    @if (session('status'))
    <h6 class="alert alet-success">{{session('status')}}</h6>
    @endif
    <button type="button" class="btn btn-primary third-color"><a href="{{url('kategori/create')}}" class="text-decoration-none text-light">Tambah Kategori</a> </button>
    <table class="table container">
        <thead align="center">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Option</th>
            </tr>
        </thead>
        <tbody align="center">
            @foreach($kategori as $data)
            <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $data->nama_kategori }}</td>
                <td>
                    <button type="button" class="btn btn-primary third-color"><a href="{{ route('kategori.edit', $data->id) }}" class="text-light text-decoration-none">Update</a> </button>
                    <button type="button" class="btn btn-danger">
                        <a href="#" class="text-white text-decoration-none" onclick="event.preventDefault();document.getElementById('delete-form-{{$data->id}}').submit();">
                            Delete
                            <form id="delete-form-{{$data->id}}" action="{{url('kategori/delete/'. $data->id)}}" method="POST" style="display:none";>
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
