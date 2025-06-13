<?php

namespace App\Http\Controllers;

use App\Models\Jenjang;
use Illuminate\Http\Request;

class JenjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jenjang::all();
        return view("admin.pages.jenjang.jenjang", ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Jenjang::all();
        return view('admin.pages.jenjang.jenjangcreate', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namajenjang' => 'required|max:255'
        ]);
        $tambahdata = Jenjang::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/jenjang')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/jenjang')->with('success', 'Data created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenjang $jenjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenjang $jenjang)
    {
        $data = Jenjang::all();
        return view('admin.pages.jenjang.jenjangedit', ['jenjang' => $jenjang], ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenjang $jenjang)
    {
        $validatedData = $request->validate([
            'namajenjang' => 'required|max:255'
        ]);
        $jenjang->update($validatedData);
        return redirect('admin/jenjang')->with('success', 'Data has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Jenjang::findOrFail($id);
        $data->delete();
        return redirect('/admin/jenjang')->with('success', 'Data has been deleted');
    }
}
