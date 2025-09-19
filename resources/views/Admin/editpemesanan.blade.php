@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Pemesanan</h2>

    <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" 
                   value="{{ old('nama_lengkap', $pemesanan->nama_lengkap) }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_identitas" class="form-label">Nomor Identitas</label>
            <input type="text" name="nomor_identitas" class="form-control" 
                   value="{{ old('nomor_identitas', $pemesanan->nomor_identitas) }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">No HP</label>
            <input type="text" name="no_hp" class="form-control" 
                   value="{{ old('no_hp', $pemesanan->no_hp) }}" required>
        </div>

      <div class="mb-3">
   
</div>


        <div class="mb-3">
            <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
            <input type="date" name="tanggal_kunjungan" class="form-control" 
                   value="{{ old('tanggal_kunjungan', $pemesanan->tanggal_kunjungan) }}" required>
        </div>

        <div class="mb-3">
            <label for="pengunjung_dewasa" class="form-label">Pengunjung Dewasa</label>
            <input type="number" name="pengunjung_dewasa" class="form-control" 
                   value="{{ old('pengunjung_dewasa', $pemesanan->pengunjung_dewasa) }}" required>
        </div>

        <div class="mb-3">
            <label for="pengunjung_anak" class="form-label">Pengunjung Anak</label>
            <input type="number" name="pengunjung_anak" class="form-control" 
                   value="{{ old('pengunjung_anak', $pemesanan->pengunjung_anak) }}" required>
        </div>

        <div class="mb-3">
            <label for="total_bayar" class="form-label">Total Bayar</label>
            <input type="number" step="0.01" name="total_bayar" id="total_bayar" class="form-control" 
                   value="{{ old('total_bayar', $pemesanan->total_bayar) }}" required readonly>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
    <script>
        // Ambil harga tiket dari destinasi yang dipilih
        const destinasiData = @json($destinasi->pluck('harga_tiket', 'id'));
        function hitungTotalBayar() {
            const destinasiId = document.getElementById('destinasi_id').value;
            const hargaTiket = destinasiData[destinasiId] ? parseFloat(destinasiData[destinasiId]) : 0;
            const dewasa = parseInt(document.querySelector('[name="pengunjung_dewasa"]').value) || 0;
            const anak = parseInt(document.querySelector('[name="pengunjung_anak"]').value) || 0;
            // Misal harga tiket anak 50% dari dewasa
            const total = (dewasa * hargaTiket) + (anak * hargaTiket * 0.5);
            document.getElementById('total_bayar').value = total;
        }
        document.getElementById('destinasi_id').addEventListener('change', hitungTotalBayar);
        document.querySelector('[name="pengunjung_dewasa"]').addEventListener('input', hitungTotalBayar);
        document.querySelector('[name="pengunjung_anak"]').addEventListener('input', hitungTotalBayar);
        window.addEventListener('DOMContentLoaded', hitungTotalBayar);
    </script>
</div>
@endsection
