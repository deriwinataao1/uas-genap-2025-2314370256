@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8">
    <h1 class="text-xl font-bold mb-4">Riwayat Pesanan</h1>
    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Status</th>
                @if ($user->role === 'admin')
                    <th>User</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{ $order->order_code }}</td>
                <td>{{ $order->product->name ?? '-' }}</td>
                <td>{{ $order->quantity }}</td>
                <td>Rp{{ number_format($order->total_harga, 0, ',', '.') }}</td>
                <td>{{ $order->status }}</td>
                @if ($user->role === 'admin')
                    <td>{{ $order->user->name ?? '-' }}</td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
