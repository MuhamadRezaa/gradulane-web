<?php

namespace App\Http\Controllers;

use App\Models\Tahunajaran;
use Illuminate\Http\Request;

class TahunajaranController extends Controller
{
    public function index()
    {
        $data = Tahunajaran::all();
        return view("admin.pages.tahunajaran.tahunajaran", ['data' => $data]);
    }

    public function create()
    {
        $data = Tahunajaran::all();
        return view('admin.pages.tahunajaran.tahunajarancreate', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tahunajaran' => 'required|max:255',
            'status' => 'required|string|in:Aktif,Tidak Aktif'
        ]);
        $tambahdata = Tahunajaran::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/tahunajaran')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/tahunajaran')->with('success', 'Data created successfully');
    }

    public function edit(Tahunajaran $tahunajaran)
    {
        $data = Tahunajaran::all();
        return view('admin.pages.tahunajaran.tahunajaranedit', ['tahunajaran' => $tahunajaran], ['data' => $data]);
    }

    public function update(Request $request, Tahunajaran $tahunajaran)
    {
        $validatedData = $request->validate([
            'tahunajaran' => 'required|max:255',
            'status' => 'required|string|in:Aktif,Tidak Aktif'
        ]);
        $tahunajaran->update($validatedData);
        return redirect('admin/tahunajaran')->with('success', 'Data has been updated');
    }

    public function destroy(Tahunajaran $tahunajaran)
    {
        $tahunajaran->delete();
        return redirect('/admin/tahunajaran')->with('success', 'Data has been deleted');
    }
}
