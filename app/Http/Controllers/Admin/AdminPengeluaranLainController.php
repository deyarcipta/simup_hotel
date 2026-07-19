<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\PengeluaranLain;
use Illuminate\Http\Request;

class AdminPengeluaranLainController extends Controller
{
    public function index()
    {
        $pengeluaran = PengeluaranLain::all();

        return view('admin.pengeluaran.lain.index', compact('pengeluaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string',
            'total' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $pengeluaran = PengeluaranLain::create($request->only('keterangan', 'total', 'tanggal'));

        return redirect()->back()->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function getData($id)
    {
        $data = PengeluaranLain::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string',
            'total' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $pengeluaran = PengeluaranLain::findOrFail($id);
        $pengeluaran->keterangan = $request->keterangan;
        $pengeluaran->total = $request->total;
        $pengeluaran->tanggal = $request->tanggal;
        $pengeluaran->save();

        return redirect()->route('pengeluaran-lain.index')->with('success', 'Pengeluaran berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pengeluaran = PengeluaranLain::findOrFail($id);
        $pengeluaran->delete();

        return back()->with('success', 'Data pengeluaran berhasil dihapus');
    }
}
