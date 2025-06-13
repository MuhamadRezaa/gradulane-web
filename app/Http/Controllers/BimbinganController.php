<?php

namespace App\Http\Controllers;

use App\Models\Sita;
use App\Models\Dosen;
use App\Models\Sempro;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BimbinganController extends Controller
{
    public function index()
    {
        if (Gate::allows('isMahasiswa')) {
            $data = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
                ->where('status_usulan', '1')
                ->get();

            return view('admin.pages.bimbingan.bimbingan', ['data' => $data]);
        } elseif (Gate::allows('isDosen')) {
            $pembimbingId = Dosen::where('email', Auth::user()->email)->pluck('id')->first();

            $data = TugasAkhir::where('pembimbing1', $pembimbingId)->orWhere('pembimbing2', $pembimbingId)
                ->where('status_usulan', '1')->get();

            return view('admin.pages.bimbingan.bimbingan', ['data' => $data, 'pembimbingId' => $pembimbingId]);
        } elseif (Gate::allows('isKaprodi')) {
            $pembimbingId = Dosen::where('email', Auth::user()->email)->pluck('id')->first();

            $data = TugasAkhir::where('pembimbing1', $pembimbingId)->orWhere('pembimbing2', $pembimbingId)
                ->where('status_usulan', '1')->get();

            return view('admin.pages.bimbingan.bimbingan', ['data' => $data, 'pembimbingId' => $pembimbingId]);
        }
    }

    public function detail($id)
    {
        if (Gate::allows('isMahasiswa')) {
            $mahasiswa = Mahasiswa::where('email', Auth::user()->email)->first();
            $bimbingan = TugasAkhir::where('mahasiswa_id', $mahasiswa->id)
                ->where('status_usulan', '1')
                ->find($id);
            $dataPembimbing1 = Bimbingan::where('pembimbing_id', $bimbingan->pembimbing1)->where('tugasakhir_id', $bimbingan->id)->get();
            $dataPembimbing2 = Bimbingan::where('pembimbing_id', $bimbingan->pembimbing2)->where('tugasakhir_id', $bimbingan->id)->get();
            return view('admin.pages.bimbingan.bimbingandetail', [
                'bimbingan' => $bimbingan,
                'dataPembimbing1' => $dataPembimbing1,
                'dataPembimbing2' => $dataPembimbing2,
            ]);
        } elseif (Gate::allows('isDosen')) {
            $bimbingan = TugasAkhir::with('mahasiswa', 'pembimbingta1', 'pembimbingta2')
                ->where('status_usulan', '1')
                ->find($id);

            $pembimbingId = Dosen::where('email', Auth::user()->email)->pluck('id')->first();

            $data = Bimbingan::where('pembimbing_id', $pembimbingId)
                ->where('tugasakhir_id', $bimbingan->id)
                ->get();

            $cek = Sita::where('tugasakhir_id', $id)->wherenot('status', 7)->get();
            if ($bimbingan->pembimbing1 == $pembimbingId) {
                $cek = $cek->where('pembimbing1_acc', 1)->first();
            } elseif ($bimbingan->pembimbing2 == $pembimbingId) {
                $cek = $cek->where('pembimbing2_acc', 1)->first();
            } else {
                return back()->with('Failed', 'Mohon maaf ada kesalahan pada sistem kami');
            }

            // $bimbinganCount = Bimbingan::where('verifikasibimbingan', '=', 1)
            //     ->where('pembimbing_id', $pembimbingId)
            //     ->count();
            $bimbinganCount = DB::table('bimbingans')
                ->whereRaw("verifikasibimbingan = '1' AND pembimbing_id = ?", [$pembimbingId])
                ->count();

            return view('admin.pages.bimbingan.bimbingandetail', [
                'pembimbingId' => $pembimbingId,
                'bimbingan' => $bimbingan,
                'data' => $data,
                'cek' => $cek,
                'bimbinganCount' => $bimbinganCount,
            ]);
        } elseif (Gate::allows('isKaprodi')) {
            $bimbingan = TugasAkhir::with('mahasiswa', 'pembimbingta1', 'pembimbingta2')
                ->where('status_usulan', '1')
                ->find($id);

            $pembimbingId = Dosen::where('email', Auth::user()->email)->pluck('id')->first();

            $data = Bimbingan::where('pembimbing_id', $pembimbingId)
                ->where('tugasakhir_id', $bimbingan->id)
                ->get();

            $cek = Sita::where('tugasakhir_id', $id)->wherenot('status', 7)->get();
            if ($bimbingan->pembimbing1 == $pembimbingId) {
                $cek = $cek->where('pembimbing1_acc', 1)->first();
            } elseif ($bimbingan->pembimbing2 == $pembimbingId) {
                $cek = $cek->where('pembimbing2_acc', 1)->first();
            } else {
                return back()->with('Failed', 'Mohon maaf ada kesalahan pada sistem kami');
            }

            $bimbinganCount = Bimbingan::where('verifikasibimbingan', 1)
                ->where('pembimbing_id', $pembimbingId)
                ->count();

            return view('admin.pages.bimbingan.bimbingandetail', [
                'pembimbingId' => $pembimbingId,
                'bimbingan' => $bimbingan,
                'data' => $data,
                'cek' => $cek,
                'bimbinganCount' => $bimbinganCount,
            ]);
        }
    }

    public function addpembahasanpembimbing1()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $bimbingan = TugasAkhir::where('mahasiswa_id', $mahasiswa->id)
            ->where('status_usulan', '1')
            ->first(); // Ambil entri pertama yang memenuhi syarat
        $data = Bimbingan::all();

        return view('admin.pages.bimbingan.bimbinganp1create', [
            'bimbingan' => $bimbingan,
            'data' => $data,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function storepembahasanpembimbing1(Request $request)
    {
        $validatedData = $request->validate([
            'tglbimbingan' => 'required',
            'pembahasan' => 'required',
            'tugasakhir_id' => 'required|exists:tugasakhirs,id'
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasakhir = TugasAkhir::with('bimbingan.mahasiswa')->find($validatedData['tugasakhir_id']);
        $validatedData['tugasakhir_id'] = $tugasakhir->id;
        $validatedData['pembimbing_id'] = $tugasakhir->pembimbing1;
        if ($mahasiswa) {
            $validatedData['mahasiswa_id'] = $mahasiswa->id;
        }
        $tambahdata = Bimbingan::create($validatedData);

        $tugasakhirid = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
            ->where('status_usulan', '1')
            ->first();
        if (!$tambahdata) {
            return redirect('admin/bimbingan')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/bimbingan/detail/' . $tugasakhirid->id)->with('success', 'Data berhasil ditambahkan');
    }

    public function addpembahasanpembimbing2()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $bimbingan = TugasAkhir::where('mahasiswa_id', $mahasiswa->id)
            ->where('status_usulan', '1')
            ->first(); // Ambil entri pertama yang memenuhi syarat

        $data = Bimbingan::all();

        return view('admin.pages.bimbingan.bimbinganp2create', [
            'bimbingan' => $bimbingan,
            'data' => $data,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function storepembahasanpembimbing2(Request $request)
    {
        $validatedData = $request->validate([
            'tglbimbingan' => 'required',
            'pembahasan' => 'required',
            'tugasakhir_id' => 'required|exists:tugasakhirs,id'
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasakhir = TugasAkhir::with('bimbingan.mahasiswa')->find($validatedData['tugasakhir_id']);
        $validatedData['tugasakhir_id'] = $tugasakhir->id;
        $validatedData['pembimbing_id'] = $tugasakhir->pembimbing2;
        if ($mahasiswa) {
            $validatedData['mahasiswa_id'] = $mahasiswa->id;
        }
        $tambahdata = Bimbingan::create($validatedData);
        $tugasakhirid = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
            ->where('status_usulan', '1')
            ->first();
        if (!$tambahdata) {
            return redirect('admin/bimbingan')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/bimbingan/detail/' . $tugasakhirid->id)->with('success', 'Data berhasil ditambahkan');
    }

    public function editPembahasanP1($id)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasakhir = TugasAkhir::with('bimbingan.mahasiswa')
            ->where('status_usulan', '1')
            ->first();
        $bimbingan = Bimbingan::findOrFail($id); // Ambil bimbingan berdasarkan ID

        return view('admin.pages.bimbingan.bimbinganp1edit', [
            'bimbingan' => $bimbingan,
            'mahasiswa' => $mahasiswa,
            'tugasakhir' => $tugasakhir
        ]);
    }

    public function updatePembahasanP1(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tglbimbingan' => 'required|date',
            'pembahasan' => 'required',
            'tugasakhir_id' => 'required|exists:tugasakhirs,id',
        ]);

        $bimbingan = Bimbingan::findOrFail($id); // Ambil bimbingan berdasarkan ID
        $bimbingan->update($validatedData); // Update data bimbingan
        $tugasakhirid = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
            ->where('status_usulan', '1')
            ->first();
        return redirect('/admin/bimbingan/detail/' . $tugasakhirid->id)->with('success', 'Data berhasil diperbarui');
    }

    public function editPembahasanP2($id)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasakhir = TugasAkhir::with('bimbingan.mahasiswa')
            ->where('status_usulan', '1')
            ->first();
        $bimbingan = Bimbingan::findOrFail($id); // Ambil bimbingan berdasarkan ID

        return view('admin.pages.bimbingan.bimbinganp2edit', [
            'bimbingan' => $bimbingan,
            'mahasiswa' => $mahasiswa,
            'tugasakhir' => $tugasakhir
        ]);
    }

    public function updatePembahasanP2(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tglbimbingan' => 'required|date',
            'pembahasan' => 'required',
            'tugasakhir_id' => 'required|exists:tugasakhirs,id',
        ]);

        $bimbingan = Bimbingan::findOrFail($id); // Ambil bimbingan berdasarkan ID
        $bimbingan->update($validatedData); // Update data bimbingan

        $tugasakhirid = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
            ->where('status_usulan', '1')
            ->first();
        return redirect('/admin/bimbingan/detail/' . $tugasakhirid->id)->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = Bimbingan::findOrFail($id);
        $data->delete();
        $tugasakhirid = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
            ->where('status_usulan', '1')
            ->first();
        return redirect('/admin/bimbingan/detail/' . $tugasakhirid->id)->with('success', 'Proposal berhasil dihapus.');
    }

    public function validasibimbingan(Request $request, $id)
    {
        $validatedData = $request->validate([
            'verifikasibimbingan' => 'required|boolean',
        ]);

        $bimbingan = Bimbingan::findOrFail($id);

        $bimbingan->verifikasibimbingan = $validatedData['verifikasibimbingan'];
        $bimbingan->save();

        return redirect()->back()->with('success', 'Bimbingan berhasil divalidasi!');
    }
}
