<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Golongan::all();
        return view("admin.pages.golongan.golongan", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Golongan::all();
        return view('admin.pages.golongan.golongancreate', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namagolongan' => 'required|max:255'
        ]);
        $tambahdata = Golongan::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/golongan')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/golongan')->with('success', 'Data created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Golongan $golongan)
    {
        $data = Golongan::all();
        return view('admin.pages.golongan.golonganedit', ['golongan' => $golongan], ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Golongan $golongan)
    {
        $data = Golongan::all();
        return view('admin.pages.golongan.golonganedit', ['golongan' => $golongan], ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Golongan $golongan)
    {
        $validatedData = $request->validate([
            'namagolongan' => 'required|max:255'
        ]);
        $golongan->update($validatedData);
        return redirect('admin/golongan')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Golongan $golongan)
    {
        // $data = golongan::findOrFail($id);
        $golongan->delete();
        return redirect('/admin/golongan')->with('success', 'Data has been deleted');
    }
}
