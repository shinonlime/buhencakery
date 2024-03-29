@extends('admin.admin-layout')

@section('section')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Tambah Produk</h1>
</div>

<div class="">
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <label for="name" class="form-label mt-2">Nama Produk</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <label for="price" class="form-label mt-2">Harga</label>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
        @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <label for="description" class="form-label mt-2">Deskripsi Produk</label>
        <textarea type="number" class="form-control @error('description') is-invalid @enderror" id="description" style="height: 100px" name="description">{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <label for="pict" class="form-label mt-2">Gambar Produk</label>
        <input class="form-control @error('pict') is-invalid @enderror" type="file" id="pict" name="pict">
        @error('pict')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        <button class="btn btn-secondary mt-4" type="submit">Submit</button>
    </form>
</div>
@endsection
