@extends('admin.admin-layout')

@section('section')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Pesanan</h1>
</div>

@if (session()->has('success'))
<div class="alert alert-success" role="alert">
    {{ session()->get('success') }}
</div>
@endif

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
                    <a href="" class="btn btn-sm btn-danger bi bi-x-lg text-white" data-bs-toggle="modal" data-bs-target="#cancel-{{ $order->id }}">&nbsp; Batalkan</a>
                </div>
                <div class="modal fade" id="cancel-{{ $order->id }}" tabindex="-1" aria-labelledby="cancel-{{ $order->id }}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cancel-{{ $order->id }}-label">Membatalkan Pesanan No. {{ $order->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin mengbatalkan pesanan no. {{ $order->id }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                <a href="/admin/order/batal/{{ $order->id }}" class="btn btn-danger text-white">Batalkan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection