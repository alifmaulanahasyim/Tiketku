<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Tiket Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg">
       
        <div class="card-body">
            <form action="{{ route('pemesanan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor Identitas</label>
                    <input type="text" name="nomor_identitas" class="form-control" maxlength="16" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="no_hp" class="form-control" maxlength="15" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Tempat Wisata</label>
                    <select name="destinasi_wisata_id" id="destinasi_wisata_id" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach($destinasi as $d)
                            <option value="{{ $d->id }}" data-harga="{{ $d->harga_tiket }}" @if(isset($destinasiTerpilih) && $destinasiTerpilih->id == $d->id) selected @endif>
                                {{ $d->nama_wisata }} (Rp {{ number_format($d->harga_tiket,0,',','.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Kunjungan</label>
                    <input type="date" name="tanggal_kunjungan" class="form-control" required>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Jumlah Dewasa</label>
                        <input type="number" name="pengunjung_dewasa" id="dewasa" class="form-control" min="0" value="0" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Jumlah Anak-anak (< 12 Tahun)</label>
                        <input type="number" name="pengunjung_anak" id="anak" class="form-control" min="0" value="0" required>
                    </div>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="setuju_syarat" value="1" required>
                    <label class="form-check-label">Saya menyetujui syarat dan ketentuan</label>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success">Pesan Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const inputDewasa = document.getElementById('dewasa');
    const inputAnak = document.getElementById('anak');
    const totalBayar = document.getElementById('totalBayar');
    const selectDestinasi = document.getElementById('destinasi_wisata_id');
    let hargaNormal = 10000;

    function hitungTotal() {
        let dewasa = parseInt(inputDewasa.value) || 0;
        let anak = parseInt(inputAnak.value) || 0;
        let total = (dewasa * hargaNormal) + (anak * (hargaNormal / 2));
        totalBayar.value = total.toLocaleString('id-ID');
        document.getElementById('totalBayarHidden').value = total;
    }

    selectDestinasi.addEventListener('change', function() {
        hargaNormal = parseInt(this.options[this.selectedIndex].getAttribute('data-harga')) || 10000;
        // Reset total bayar jika destinasi berubah
        totalBayar.value = '';
        document.getElementById('totalBayarHidden').value = '';
    });
    // Tombol cek harga
    document.getElementById('cekHargaBtn').addEventListener('click', hitungTotal);
</script>

</body>
</html>
