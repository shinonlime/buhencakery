@extends('admin.admin-layout')

@section('section')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Order</h1>
</div>

<table class="table align-middle">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Tanggal</th>
        <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $order->nama }}</td>
            <td>{{ $order->tanggal }}</td>
            <td>
                <div class="d-flex justify-content-end">
                    <a href="/admin/order/detail/{{ $order->id }}" class="btn btn-sm btn-primary bi bi-list-ul me-2">&nbsp; Detail</a>
                    <a href="/admin/order/batal/{{ $order->id }}" class="btn btn-sm btn-danger bi bi-x-lg text-white">&nbsp; Batalkan</a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection