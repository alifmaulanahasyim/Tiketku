<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bill Pemesanan Tiket</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; background: #fff; color: #222; }
        .container { width: 90%; margin: 0 auto; }
        .card { border: 1px solid #ddd; border-radius: 8px; margin-top: 30px; }
        .card-header { background: #198754; color: #fff; padding: 16px; border-radius: 8px 8px 0 0; text-align: center; }
        .card-body { padding: 24px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { padding: 8px 12px; border: 1px solid #ddd; }
        th { background: #f8f9fa; text-align: left; }
        .total { font-weight: bold; font-size: 1.1em; }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Bill Pemesanan Tiket</h3>
        </div>
        <div class="card-body">
            <table>
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
                    <td>{{ $pemesanan->destinasi ? $pemesanan->destinasi->nama_wisata : '-' }}</td>
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
                    <td class="total">
                        Rp {{ number_format($pemesanan->destinasi->harga_tiket * $pemesanan->pengunjung_dewasa,0,',','.') }}
                        + Rp {{ number_format(($pemesanan->destinasi->harga_tiket * 0.5) * $pemesanan->pengunjung_anak,0,',','.') }}
                        = <strong>Rp {{ number_format($pemesanan->total_bayar,0,',','.') }}</strong>
                    </td>
                </tr>
            </table>
            <div style="text-align:center; margin-top:30px;">
                <small>Terima kasih telah melakukan pemesanan tiket. Simpan bill ini sebagai bukti pembayaran.</small>
            </div>
        </div>
    </div>
</div>
</body>
</html>
