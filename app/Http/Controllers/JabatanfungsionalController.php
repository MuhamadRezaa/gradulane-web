<?php

namespace App\Http\Controllers;

use App\Models\Jabatanfungsional;
use Illuminate\Http\Request;

class JabatanfungsionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jabatanfungsional::all();
        return view("admin.pages.jabatanfungsional.jabatanfungsional", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Jabatanfungsional::all();
        return view('admin.pages.jabatanfungsional.jabatanfungsionalcreate', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'jabatanfungsional' => 'required|max:255'
        ]);

        $tambahdata = Jabatanfungsional::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/jabatanfungsional')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/jabatanfungsional')->with('success', 'Data created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatanfungsional $jabatanfungsional)
    {
        $data = Jabatanfungsional::all();
        return view('admin.pages.jabatanfungsional.jabatanfungsionaledit', ['jabatanfungsional' => $jabatanfungsional], ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatanfungsional $jabatanfungsional)
    {
        $data = Jabatanfungsional::all();
        return view('admin.pages.jabatanfungsional.jabatanfungsionaledit', ['jabatanfungsional' => $jabatanfungsional], ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jabatanfungsional $jabatanfungsional)
    {
        $validatedData = $request->validate([
            'jabatanfungsional' => 'required|max:255'
        ]);

        $jabatanfungsional->update($validatedData);
        return redirect('admin/jabatanfungsional')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(jabatanfungsional $jabatanfungsional)
    {
        $jabatanfungsional->delete();
        return redirect('/admin/jabatanfungsional')->with('success', 'Data has been deleted');
    }
}
