<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemesananTiket;

class KelolaPemesananController extends Controller
{
    // Tampilkan semua data
    public function index()
{
    $pemesanan = \App\Models\PemesananTiket::with('destinasi')->orderByDesc('created_at')->get();
    return view('admin.kelolapemesanan', compact('pemesanan'));
}

    // Form edit data
    public function edit($id)
    {
        $pemesanan = PemesananTiket::findOrFail($id);
        $destinasi = \App\Models\DestinasiWisata::all();
        return view('admin.editpemesanan', compact('pemesanan', 'destinasi'));
    }

public function update(Request $request, $id)
{
    $pemesanan = PemesananTiket::findOrFail($id);

    $validated = $request->validate([
        'nama_lengkap' => 'required|string|max:255',
        'nomor_identitas' => 'required|string|max:16',
        'no_hp' => 'required|string|max:15',
        // 'destinasi_id' => 'required|exists:destinasi_wisata,id', // validasi dimatikan
        'tanggal_kunjungan' => 'required|date',
        'pengunjung_dewasa' => 'required|integer|min:0',
        'pengunjung_anak' => 'required|integer|min:0',
        'total_bayar' => 'required|numeric|min:0',
    ]);

    $pemesanan->nama_lengkap = $validated['nama_lengkap'];
    $pemesanan->nomor_identitas = $validated['nomor_identitas'];
    $pemesanan->no_hp = $validated['no_hp'];
    if(isset($validated['destinasi_id'])) {
        $pemesanan->destinasi_wisata_id = $validated['destinasi_id'];
    }
    $pemesanan->tanggal_kunjungan = $validated['tanggal_kunjungan'];
    $pemesanan->pengunjung_dewasa = $validated['pengunjung_dewasa'];
    $pemesanan->pengunjung_anak = $validated['pengunjung_anak'];
    $pemesanan->total_bayar = $validated['total_bayar'];
    $pemesanan->save();

    return redirect()->route('admin.pemesanan.index')->with('success', 'Pemesanan berhasil diperbarui.');
}
public function destroy($id)
{
    $pemesanan = \App\Models\PemesananTiket::findOrFail($id);
    $pemesanan->delete();
    return redirect()->back()->with('success', 'Data pemesanan berhasil dihapus!');
}

}
