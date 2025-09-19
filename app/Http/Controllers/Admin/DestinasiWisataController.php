<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\DestinasiWisata;

class DestinasiWisataController extends Controller
{
    // Tampilkan daftar destinasi wisata
    public function index()
    {
        $destinasi = DestinasiWisata::orderBy('created_at', 'desc')->get();
        return view('Admin.keloladestinasi', compact('destinasi'));
    }

    // Tampilkan form tambah destinasi wisata
    public function create()
    {
        return view('Admin.tambahdestinasi');
    }

    // Simpan data destinasi wisata
    public function store(Request $request)
    {
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'required|string|max:255',
            'harga_tiket' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_url' => 'nullable|string|max:255',
            'maps_embed' => 'nullable|string',
        ]);

        $data = $request->only(['nama_wisata', 'deskripsi', 'lokasi', 'harga_tiket', 'youtube_url', 'maps_embed']);
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('objek_wisata', 'public');
        }
        DestinasiWisata::create($data);
    return redirect()->route('admin.destinasi.index')->with('success', 'Objek wisata berhasil ditambahkan!');
    }

    // Tampilkan form edit destinasi wisata
    public function edit($id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);
        return view('Admin.editdestinasi', compact('destinasi'));
    }

    // Update data destinasi wisata
    public function update(Request $request, $id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);
        $request->validate([
            'nama_wisata' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'required|string|max:255',
            'harga_tiket' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'youtube_url' => 'nullable|string|max:255',
            'maps_embed' => 'nullable|string',
        ]);

        $data = $request->only(['nama_wisata', 'deskripsi', 'lokasi', 'harga_tiket', 'youtube_url', 'maps_embed']);
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($destinasi->gambar && Storage::disk('public')->exists($destinasi->gambar)) {
                Storage::disk('public')->delete($destinasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('objek_wisata', 'public');
        }
        $destinasi->update($data);
        return redirect()->route('admin.destinasi.index')->with('success', 'Data destinasi berhasil diupdate!');
    }

    // Hapus destinasi wisata
    public function destroy($id)
    {
        $destinasi = DestinasiWisata::findOrFail($id);
        // Hapus gambar jika ada
        if ($destinasi->gambar && Storage::disk('public')->exists($destinasi->gambar)) {
            Storage::disk('public')->delete($destinasi->gambar);
        }
        $destinasi->delete();
        return redirect()->route('admin.destinasi.index')->with('success', 'Data destinasi berhasil dihapus!');
    }
}
