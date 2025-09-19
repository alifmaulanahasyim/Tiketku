@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-success text-white text-center">
            <h3>Bill Pemesanan Tiket</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $pemesanan->nama_lengkap }}</td>
                </tr>
                <tr>
                    <th>Nomor Identitas</th>
                    <td>{{ $pemesanan->nomor_identitas }}</td>
                </tr>
                <tr>
                    <th>Nomor HP</th>
                    <td>{{ $pemesanan->no_hp }}</td>
                </tr>
                <tr>
                    <th>Tempat Wisata</th>
                    <td>{{ $pemesanan->destinasi->nama_wisata }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kunjungan</th>
                    <td>{{ $pemesanan->tanggal_kunjungan }}</td>
                </tr>
                <tr>
                    <th>Jumlah Dewasa</th>
                    <td>{{ $pemesanan->pengunjung_dewasa }}</td>
                </tr>
                <tr>
                    <th>Jumlah Anak-anak</th>
                    <td>{{ $pemesanan->pengunjung_anak }}</td>
                </tr>
                <tr>
                    <th>Harga Tiket Dewasa</th>
                    <td>Rp {{ number_format($pemesanan->destinasi->harga_tiket,0,',','.') }} x {{ $pemesanan->pengunjung_dewasa }} = Rp {{ number_format($pemesanan->destinasi->harga_tiket * $pemesanan->pengunjung_dewasa,0,',','.') }}</td>
                </tr>
                <tr>
                    <th>Harga Tiket Anak-anak (50%)</th>
                    <td>Rp {{ number_format($pemesanan->destinasi->harga_tiket,0,',','.') }} x 50% x {{ $pemesanan->pengunjung_anak }} = Rp {{ number_format(($pemesanan->destinasi->harga_tiket * 0.5) * $pemesanan->pengunjung_anak,0,',','.') }}</td>
                </tr>
                <tr>
                    <th>Total Bayar</th>
                    <td>
                        Rp {{ number_format($pemesanan->destinasi->harga_tiket * $pemesanan->pengunjung_dewasa,0,',','.') }}
                        + Rp {{ number_format(($pemesanan->destinasi->harga_tiket * 0.5) * $pemesanan->pengunjung_anak,0,',','.') }}
                        = <strong>Rp {{ number_format($pemesanan->total_bayar,0,',','.') }}</strong>
                    </td>
                </tr>
            </table>
            <div class="text-center mt-4">
                <a href="{{ route('pemesanan.bill.pdf', $pemesanan->id) }}" class="btn btn-danger me-2" target="_blank">
                    <i class="fas fa-file-pdf"></i> Download Bukti Pembayaran
                </a>
                <a href="{{ route('user.menu') }}" class="btn btn-primary">Kembali ke Menu</a>
            </div>
        </div>
    </div>
</div>
@endsection
