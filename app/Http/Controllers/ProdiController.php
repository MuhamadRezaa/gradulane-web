<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function index()
    {
        $data = Prodi::all();
        return view("admin.pages.prodi.prodi", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Prodi::all();
        $jurusan = Jurusan::all();
        return view('admin.pages.prodi.prodicreate', [
            'data' => $data,
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jurusan_id' => 'required|max:255',
            'namajenjang' => 'required|max:255',
            'namaprodi' => 'required|max:255'
        ]);
        $tambahdata = Prodi::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/prodi')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/prodi')->with('success', 'Data created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        $data = Prodi::all();
        $jurusan = Jurusan::all();
        return view('admin.pages.prodi.prodiedit', [
            'prodi' => $prodi,
            'data' => $data,
            'jurusan' => $jurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        $validatedData = $request->validate([
            'jurusan_id' => 'required|max:255',
            'namajenjang' => 'required|max:255',
            'namaprodi' => 'required|max:255'
        ]);
        $prodi->update($validatedData);
        return redirect('/admin/prodi')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prodi $prodi)
    {
        $prodi->delete();
        return redirect('/admin/prodi')->with('success', 'Data has been deleted');
    }
}
