@extends('layouts.admin')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-dark text-white">
            <h3 class="text-center">Kelola Pemesanan Tiket</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>No Identitas</th>
                        <th>No HP</th>
                        <th>Tempat Wisata</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Dewasa</th>
                        <th>Anak</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->nama_lengkap }}</td>
                            <td>{{ $item->nomor_identitas }}</td>
                            <td>{{ $item->no_hp }}</td>
                            <td>{{ $item->destinasi ? $item->destinasi->nama_wisata : '-' }}</td>
                            <td>{{ $item->tanggal_kunjungan }}</td>
                            <td>{{ $item->pengunjung_dewasa }}</td>
                            <td>{{ $item->pengunjung_anak }}</td>
                            <td>Rp {{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.pemesanan.edit', $item->id) }}" class="btn btn-warning btn-sm mb-1">Edit</a>
                                <form action="{{ route('admin.pemesanan.destroy', $item->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Belum ada pemesanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
    <!-- Konten halaman admin di sini -->
@endsection