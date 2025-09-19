<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananTiket extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pemesanan_tiket';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_lengkap',
        'nomor_identitas',
        'no_hp',
        'tanggal_kunjungan',
        'pengunjung_dewasa',
        'pengunjung_anak',
        'total_bayar',
        'setuju_syarat',
        'destinasi_wisata_id',
    ];

    public function destinasi()
    {
        return $this->belongsTo(DestinasiWisata::class, 'destinasi_wisata_id');
    }
    
}
