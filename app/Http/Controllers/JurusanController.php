<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    //
    public function index()
    {
        $data = jurusan::all();
        return view("admin.pages.jurusan.jurusan", ['data' => $data]);
    }

    public function create()
    {
        $data = Jurusan::all();
        return view('admin.pages.jurusan.jurusancreate', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namajurusan' => 'required|max:255'
        ]);
        $tambahdata = Jurusan::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/jurusan')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/jurusan')->with('success', 'Data created successfully');
    }

    public function edit(jurusan $jurusan)
    {
        $data = Jurusan::all();
        return view('admin.pages.jurusan.jurusanedit', ['jurusan' => $jurusan], ['data' => $data]);
    }

    public function update(Request $request, jurusan $jurusan)
    {
        $validatedData = $request->validate([
            'namajurusan' => 'required|max:255'
        ]);
        $jurusan->update($validatedData);
        return redirect('admin/jurusan')->with('success', 'Data has been updated');
    }

    public function destroy($id)
    {
        $data = Jurusan::findOrFail($id);
        $data->delete();
        return redirect('/admin/jurusan')->with('success', 'Data has been deleted');
    }
}
