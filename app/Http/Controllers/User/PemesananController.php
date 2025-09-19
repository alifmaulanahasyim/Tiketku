<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemesananTiket;

class PemesananController extends Controller
{
    // Menampilkan form pemesanan
    public function create()
    {
        $destinasi = \App\Models\DestinasiWisata::all();
        return view('user.pemesanan', compact('destinasi'));
    }

    // Menampilkan form pemesanan untuk modal (AJAX)
    public function showForm($id)
    {
        $destinasiTerpilih = \App\Models\DestinasiWisata::find($id);
        $destinasi = \App\Models\DestinasiWisata::all();
        return view('user.pemesanan', [
            'destinasi' => $destinasi,
            'destinasiTerpilih' => $destinasiTerpilih
        ]);
    }

    // Menyimpan data pemesanan
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'     => 'required|string|max:255',
            'nomor_identitas'  => 'required|string|max:16',
            'no_hp'            => 'required|string|max:15',
            'destinasi_wisata_id' => 'required|exists:destinasi_wisata,id',
            'tanggal_kunjungan'=> 'required|date',
            'pengunjung_dewasa'=> 'required|integer|min:0',
            'pengunjung_anak'  => 'required|integer|min:0',
            'setuju_syarat'    => 'accepted',
        ]);

        $destinasi = \App\Models\DestinasiWisata::find($request->destinasi_wisata_id);
        $hargaTiket = $destinasi ? $destinasi->harga_tiket : 10000;
        $dewasa = $request->pengunjung_dewasa;
        $anak   = $request->pengunjung_anak;

        // Jika ada input usia anak-anak, gunakan untuk diskon (anggap input: array usia anak)
        $totalAnakDiskon = 0;
        if ($request->has('usia_anak') && is_array($request->usia_anak)) {
            foreach ($request->usia_anak as $usia) {
                if ((int)$usia < 12) {
                    $totalAnakDiskon++;
                }
            }
        } else {
            $totalAnakDiskon = $anak; // fallback: semua anak dapat diskon
        }

        $totalBayar = ($dewasa * $hargaTiket) + ($totalAnakDiskon * ($hargaTiket * 0.5));

        $pemesanan = PemesananTiket::create([
            'nama_lengkap'     => $request->nama_lengkap,
            'nomor_identitas'  => $request->nomor_identitas,
            'no_hp'            => $request->no_hp,
            'tanggal_kunjungan'=> $request->tanggal_kunjungan,
            'pengunjung_dewasa'=> $dewasa,
            'pengunjung_anak'  => $anak,
            'total_bayar'      => $totalBayar,
            'setuju_syarat'    => 1,
            'destinasi_wisata_id' => $request->destinasi_wisata_id,
        ]);

        session(['last_bill_id' => $pemesanan->id]);
        return redirect()->route('pemesanan.bill', $pemesanan->id);
    }
    // Menampilkan bill setelah pemesanan
    public function bill($id)
    {
        $pemesanan = \App\Models\PemesananTiket::with('destinasi')->findOrFail($id);
        return view('user.bill', compact('pemesanan'));
    }

    // Export bill ke PDF
    public function exportPdf($id)
    {
        $pemesanan = \App\Models\PemesananTiket::with('destinasi')->findOrFail($id);
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('user.bill_pdf', compact('pemesanan'));
        if (request()->has('preview')) {
            return $pdf->stream('bill-'.$pemesanan->id.'.pdf');
        }
        return $pdf->download('bill-'.$pemesanan->id.'.pdf');
    }
}
