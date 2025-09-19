
@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Objek Wisata</h2>
    <form action="{{ route('admin.destinasi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nama_wisata" class="form-label">Nama Objek Wisata</label>
            <input type="text" class="form-control" id="nama_wisata" name="nama_wisata" required>
        </div>
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>
        <div class="mb-3">
            <label for="harga_tiket" class="form-label">Harga Tiket</label>
            <input type="number" class="form-control" id="harga_tiket" name="harga_tiket" min="0" value="10000" required>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar </label>
            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="youtube_url" class="form-label">Link YouTube </label>
            <input type="url" class="form-control" id="youtube_url" name="youtube_url" placeholder="https://www.youtube.com/watch?v=xxxxxx">
        </div>
        <div class="mb-3">
            <label for="maps_embed" class="form-label">Embed Google Maps </label>
            <textarea class="form-control" id="maps_embed" name="maps_embed" rows="3" placeholder="Tempel kode embed iframe Google Maps di sini"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@endsection
