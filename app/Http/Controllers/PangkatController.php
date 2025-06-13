<?php

namespace App\Http\Controllers;

use App\Models\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Pangkat::all();
        return view("admin.pages.pangkat.pangkat", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Pangkat::all();
        return view('admin.pages.pangkat.pangkatcreate', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namapangkat' => 'required|max:255'
        ]);
        $tambahdata = Pangkat::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/pangkat')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/pangkat')->with('success', 'Data created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pangkat $pangkat)
    {
        $data = Pangkat::all();
        return view('admin.pages.pangkat.pangkatedit', ['pangkat' => $pangkat], ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pangkat $pangkat)
    {
        $validatedData = $request->validate([
            'namapangkat' => 'required|max:255'
        ]);
        $pangkat->update($validatedData);
        return redirect('admin/pangkat')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pangkat $pangkat)
    {
        $pangkat->delete();
        return redirect('/admin/pangkat')->with('success', 'Data has been deleted');
    }
}
