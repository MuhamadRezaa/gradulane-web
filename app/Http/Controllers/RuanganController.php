<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $data = ruangan::all();
        return view("admin.pages.ruangan.ruangan", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = ruangan::all();
        return view('admin.pages.ruangan.ruangancreate', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'koderuangan' => 'required|unique:ruangans,koderuangan|max:255',
            'namaruangan' => 'required|max:255'
        ]);
        $tambahdata = ruangan::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/ruangan')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/ruangan')->with('success', 'Data created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ruangan $ruangan)
    {
        $data = ruangan::all();
        return view('admin.pages.ruangan.ruanganedit', ['ruangan' => $ruangan], ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ruangan $ruangan)
    {
        $validatedData = $request->validate([
            'koderuangan' => 'required|unique:ruangans,koderuangan|max:255',
            'namaruangan' => 'required|max:255'
        ]);
        $ruangan->update($validatedData);
        return redirect('admin/ruangan')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect('/admin/ruangan')->with('success', 'Data has been deleted');
    }
}
