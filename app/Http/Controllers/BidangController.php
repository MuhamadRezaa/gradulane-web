<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    public function index()
    {
        $data = Bidang::all();
        return view("admin.pages.bidang.bidang", ['data' => $data]);
    }

    public function create()
    {
        $data = Bidang::all();
        return view('admin.pages.bidang.bidangcreate', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namabidang' => 'required|max:255'
        ]);
        $tambahdata = Bidang::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/bidang')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/bidang')->with('success', 'Data created successfully');
    }

    public function edit(Bidang $bidang)
    {
        $data = Bidang::all();
        return view('admin.pages.bidang.bidangedit', ['bidang' => $bidang], ['data' => $data]);
    }

    public function update(Request $request, Bidang $bidang)
    {
        $validatedData = $request->validate([
            'namabidang' => 'required|max:255'
        ]);
        $bidang->update($validatedData);
        return redirect('admin/bidang')->with('success', 'Data has been updated');
    }

    public function destroy($id)
    {
        $data = Bidang::findOrFail($id);
        $data->delete();
        return redirect('/admin/bidang')->with('success', 'Data has been deleted');
    }
}
