@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Kelola Destinasi Wisata</h2>
    <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Destinasi
    </a>
    <div class="table-responsive">
        <table class="table table-bordered admin-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Wisata</th>
                    <th>Harga Tiket</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($destinasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_wisata }}</td>             
                    <td>Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_wisata }}" width="80">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('admin.destinasi.destroy', $item->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus destinasi ini?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
@foreach($destinasi as $item)
<!-- Modal Edit Destinasi -->
<div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Destinasi: {{ $item->nama_wisata }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.destinasi.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_wisata{{ $item->id }}" class="form-label">Nama Wisata</label>
                        <input type="text" class="form-control" id="nama_wisata{{ $item->id }}" name="nama_wisata" value="{{ $item->nama_wisata }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi{{ $item->id }}" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi{{ $item->id }}" name="deskripsi" rows="3">{{ $item->deskripsi }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi{{ $item->id }}" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="lokasi{{ $item->id }}" name="lokasi" value="{{ $item->lokasi }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga_tiket{{ $item->id }}" class="form-label">Harga Tiket</label>
                        <input type="number" class="form-control" id="harga_tiket{{ $item->id }}" name="harga_tiket" value="{{ $item->harga_tiket }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Saat Ini</label><br>
                        @if($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_wisata }}" width="100">
                        @else
                            <span class="text-muted">Belum ada gambar</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="gambar{{ $item->id }}" class="form-label">Ganti Gambar</label>
                        <input class="form-control" type="file" id="gambar{{ $item->id }}" name="gambar" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data destinasi wisata.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
