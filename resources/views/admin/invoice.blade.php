@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <div class="container ">
        @if($orders->count() > 0)
            @if (Auth::user()->role ==='admin')
                <table class="table table-stripped ">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Address</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>IV-{{$order->random_code}}</td>
                            <td>{{$order->address}}</td>
                            <td>Rp {{$order->total_price}}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($order->status == 1)
                                    <span class="badge bg-success">Success</span>
                                @elseif ($order->status == 2)
                                    <span class="badge bg-danger">Canceled</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->status == 0)
                                <form action="{{url('/admin/invoice/'. $order->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <select name="proses" class="p-2 form-select" >
                                                <option {{$order->status == '1' ? "selected" : ''}} value = "1"  >Accept</option>
                                                <option {{$order->status == '2' ? "selected" : ''}} value = "2"  >Reject</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-primary third-color" > Update </button>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning" role="alert">
                    Belum ada pesanan
                </div>
            @endif
        @endif
    </div>
@endsection
