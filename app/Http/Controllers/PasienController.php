<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::orderByDesc('id')->get();
        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.form');
    }

    public function store(Request $request)
    {
        Pasien::create($request->validate($this->rules()));

        return redirect()->route('pasien.index')
            ->with('sukses', 'Data pasien berhasil disimpan!');
    }

    public function edit(Pasien $pasien)
    {
        return view('pasien.form', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $pasien->update($request->validate($this->rules($pasien->id)));

        return redirect()->route('pasien.index')
            ->with('sukses', 'Data pasien berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();

        return redirect()->route('pasien.index')
            ->with('sukses', 'Data pasien berhasil dihapus!');
    }

    private function rules($id = null): array
    {
        return [
            'nama_pasien'    => 'required|string|max:255',
            'tanggal_lahir'  => 'required|date',
            'no_rekam_medis' => 'required|string|max:50|unique:pasiens,no_rekam_medis,' . $id,
            'domisili'       => 'required|string',
            'kontak_darurat' => ['required', 'regex:/^[0-9+\- ]{8,15}$/'],
        ];
    }
}