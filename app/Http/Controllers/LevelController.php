<?php

namespace App\Http\Controllers;

use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $data = level::all();
        return view("admin.pages.level.level", ['data' => $data]);
    }

    public function create()
    {
        $data = level::all();
        return view('admin.pages.level.levelcreate', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'level' => 'required|max:255'
        ]);
        $tambahdata = level::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/level')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/level')->with('success', 'Data created successfully');
    }

    public function edit(level $level)
    {
        $data = level::all();
        return view('admin.pages.level.leveledit', ['level' => $level], ['data' => $data]);
    }

    public function update(Request $request, level $level)
    {
        $validatedData = $request->validate([
            'level' => 'required|max:255'
        ]);
        $level->update($validatedData);
        return redirect('admin/level')->with('success', 'Data has been updated');
    }

    public function destroy(Level $level)
    {
        $level->delete();
        return redirect('/admin/level')->with('success', 'Data has been deleted');
    }
}
