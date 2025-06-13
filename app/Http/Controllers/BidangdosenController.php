<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Bidang;
use App\Models\Bidangdosen;
use Illuminate\Http\Request;

class BidangdosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::with('bidangs')->get();
        return view('admin.pages.bidangdosen.bidangdosen', compact('dosens'));
    }

    public function create()
    {
        $dosens = Dosen::all();
        $bidangs = Bidang::all();
        return view('admin.pages.bidangdosen.bidangdosencreate', compact('dosens', 'bidangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
            'bidang_id' => 'required|array',
        ]);

        $dosen = Dosen::findOrFail($request->dosen_id);
        $dosen->bidangs()->attach($request->bidang_id);

        return redirect()->route('bidangdosen.index')->with('success', 'Bidang dosen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        $bidangs = Bidang::all();
        $selectedBidangIds = $dosen->bidangs->pluck('id')->toArray();

        return view('admin.pages.bidangdosen.bidangdosenedit', compact('dosen', 'bidangs', 'selectedBidangIds'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bidang_id' => 'required|array',
        ]);

        $dosen = Dosen::findOrFail($id);
        $dosen->bidangs()->sync($request->bidang_id);

        return redirect()->route('bidangdosen.index')->with('success', 'Bidang dosen untuk ' . $dosen->namadosen . ' berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->bidangs()->detach();

        return redirect()->route('bidangdosen.index')->with('success', 'Bidang dosen berhasil dihapus.');
    }
}
