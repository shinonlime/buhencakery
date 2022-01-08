@extends('admin.admin-layout')

@section('section')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
    <h1 class="h2">Daftar Produk</h1>
    <a href="{{ route('product.create') }}" class="btn btn-secondary">Tambah produk</a>
</div>
@foreach ($products as $product)
    <div class="d-flex pt-3">
        <div class="pb-3 mb-0 lh-sm border-bottom w-100">
            <div class="d-flex justify-content-between">
                <strong class="text-gray-dark">{{ $product->nama }}</strong>
                <div>
                    <a href="/admin/produk/{{ $product->id }}/edit" class="me-2">Edit</a>
                    <a href="" class="me-2 link-danger" data-bs-toggle="modal" data-bs-target="#delete-{{ $product->id }}">Delete</a>
                </div>
                </div>
                <span class="d-block">@currency($product->harga)</span>
                <span class="d-block">{{ $product->deskripsi }}</span>
                <div class="modal fade" id="delete-{{ $product->id }}" tabindex="-1" aria-labelledby="delete-{{ $product->id }}-label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete-{{ $product->id }}-label">Hapus {{ $product->nama }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menghapus {{ $product->nama }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                            <a href="/admin/produk/hapus/{{ $product->id }}" class="btn btn-danger text-white">Hapus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection