<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view("admin.pages.user.user", ['data' => $data]);
    }

    public function create()
    {
        $data = User::all();
        return view('admin.pages.user.usercreate', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'nullable|unique:users,nim|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'level' => 'required|max:255'
        ]);
        $cekmahasiswa = Mahasiswa::where('email', $validatedData['email'])->orWhere('nim', $validatedData['nim'])->first();
        $cekdosen = Dosen::where('email', $validatedData['email'])->first();

        if ($cekmahasiswa) {
            $validatedData['namalengkap'] = $cekmahasiswa->namamhs;
            $validatedData['foto'] = $cekmahasiswa->foto;
        } elseif ($cekdosen) {
            $validatedData['namalengkap'] = $cekdosen->namadosen;
            $validatedData['foto'] = $cekdosen->foto;
        } else {
            return back()->with('failed', 'Data tidak tercatat di database.');
        }
        $validatedData['password'] = Hash::make('12345678');

        $tambahdata = User::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/user')->with('failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/user')->with('success', 'Data created successfully');
    }
}
