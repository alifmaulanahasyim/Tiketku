<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DestinasiWisata;

class MenuController extends Controller
{
    public function index()
    {
    $objekWisata = DestinasiWisata::orderBy('created_at', 'desc')->get();
        return view('User.menu', compact('objekWisata'));
    }
    public function show($id)
{
    $destinasi = \App\Models\DestinasiWisata::findOrFail($id);
    return view('User.detaildestinasi', compact('destinasi'));
}
}
