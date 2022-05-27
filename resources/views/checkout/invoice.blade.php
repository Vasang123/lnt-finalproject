@extends('layouts.app')

@section('content')
    <div class="container col-md-8">
        @if($orders->count() > 0)
            @if (Auth::user()->role ==='member')
                <table class="table table-stripped ">
                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>IV-{{$order->random_code}}</td>
                            <td>Rp {{number_format($order->total_price)}}</td>
                            <td>
                                @if ($order->status == 0)
                                    <span class="badge bg-warning">Pending</span>
                                @elseif ($order->status == 1)
                                    <span class="badge bg-success">Success</span>
                                @elseif ($order->status == 2)
                                    <span class="badge bg-danger">Canceled</span>
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
