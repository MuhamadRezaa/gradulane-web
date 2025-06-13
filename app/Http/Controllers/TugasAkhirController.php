<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasAkhirController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if ($mahasiswa) {
            // Jika role adalah mahasiswa, ambil tugas akhir berdasarkan id mahasiswa
            $data = TugasAkhir::where('mahasiswa_id', $mahasiswa->id)->get();
        } else {
            // Jika bukan mahasiswa, ambil semua data tugas akhir
            $data = TugasAkhir::all();
        }
        return view("admin.pages.tugasakhir.tugasakhir", [
            'data' => $data,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function detail(TugasAkhir $tugasAkhir, $id)
    {
        $tugasAkhir = TugasAkhir::find($id);
        return view('admin.pages.tugasakhir.tugasakhirdetail', [
            'tugasAkhir' => $tugasAkhir
        ]);
    }

    public function create()
    {
        $data = TugasAkhir::all();
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        return view('admin.pages.tugasakhir.tugasakhircreate', [
            'data' => $data,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul1' => 'required|max:255',
            'judul2' => 'required|max:255',
            'dokumen_proposal1' => 'required|file|mimes:pdf,doc,docx',
            'dokumen_proposal2' => 'required|file|mimes:pdf,doc,docx',
            'cttmhs' => 'nullable'
        ]);

        $user = Auth::user();

        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if ($mahasiswa) {
            $validatedData['mahasiswa_id'] = $mahasiswa->id;

            if ($request->file('dokumen_proposal1')) {
                $nim = str_replace(' ', '_', $mahasiswa->nim);
                $namaMahasiswa = str_replace(' ', '_', $mahasiswa->namamhs);
                $extension = $request->file('dokumen_proposal1')->getClientOriginalExtension();

                $namaFileBaru = "{$nim}_{$namaMahasiswa}_proposal_1.{$extension}";

                $path = $request->file('dokumen_proposal1')->storeAs('dokumen/mahasiswa', $namaFileBaru, 'public');
                $validatedData['dokumen_proposal1'] = $path;
            }

            if ($request->file('dokumen_proposal2')) {
                $nim = str_replace(' ', '_', $mahasiswa->nim);
                $namaMahasiswa = str_replace(' ', '_', $mahasiswa->namamhs);
                $extension = $request->file('dokumen_proposal2')->getClientOriginalExtension();

                $namaFileBaru = "{$nim}_{$namaMahasiswa}_proposal_2.{$extension}";

                $path = $request->file('dokumen_proposal2')->storeAs('dokumen/mahasiswa', $namaFileBaru, 'public');
                $validatedData['dokumen_proposal2'] = $path;
            }

            $tambahdata = TugasAkhir::create($validatedData);
            if (!$tambahdata) {
                return redirect('admin/tugasakhir')->with('Failed', 'Data gagal ditambahkan');
            }
            return redirect('admin/tugasakhir')->with('success', 'Data created successfully');
        } else {
            return redirect('admin/tugasakhir/create')->with('Failed', 'Mahasiswa tidak ditemukan');
        }
    }

    public function edit(TugasAkhir $tugasAkhir, $id)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasAkhir = TugasAkhir::find($id);
        return view('admin.pages.tugasakhir.tugasakhiredit', [
            'tugasAkhir' => $tugasAkhir,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user(); // Ambil user yang sedang login
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasAkhir = TugasAkhir::find($id);
        $validatedData = $request->validate([
            'judul1' => 'max:255',
            'judul2' => 'max:255',
            'dokumen_proposal1' => 'file|mimes:pdf,doc,docx',
            'dokumen_proposal2' => 'file|mimes:pdf,doc,docx',
            'cttmhs' => 'nullable'
        ]);

        if ($request->file('dokumen_proposal1')) {
            $nim = str_replace(' ', '_', $mahasiswa->nim);
            $namaMahasiswa = str_replace(' ', '_', $mahasiswa->namamhs);
            $extension = $request->file('dokumen_proposal1')->getClientOriginalExtension();

            $namaFileBaru = "{$nim}_{$namaMahasiswa}_proposal_1.{$extension}";

            // Simpan file dokumen proposal
            $path = $request->file('dokumen_proposal1')->storeAs('dokumen/mahasiswa', $namaFileBaru, 'public');
            $validatedData['dokumen_proposal1'] = $path;
        }

        if ($request->file('dokumen_proposal2')) {
            $nim = str_replace(' ', '_', $mahasiswa->nim);
            $namaMahasiswa = str_replace(' ', '_', $mahasiswa->namamhs);
            $extension = $request->file('dokumen_proposal2')->getClientOriginalExtension();

            $namaFileBaru = "{$nim}_{$namaMahasiswa}_proposal_2.{$extension}";

            // Simpan file dokumen proposal
            $path = $request->file('dokumen_proposal2')->storeAs('dokumen/mahasiswa', $namaFileBaru, 'public');
            $validatedData['dokumen_proposal2'] = $path;
        }

        if ($tugasAkhir->status_usulan == '2' || $tugasAkhir->status_usulan == '3') {
            $validatedData['status_usulan'] = '4';
        }
        dd($validatedData);
        // Update tugas akhir dengan data yang sudah divalidasi
        $tugasAkhir->update($validatedData);

        return redirect('/admin/tugasakhir/detail/' . $tugasAkhir->id)->with('success', 'Mahasiswa updated successfully');
    }

    public function destroy(TugasAkhir $tugasAkhir, $id)
    {
        $data = TugasAkhir::findOrFail($id);
        // Cek apakah ada file yang terasosiasi untuk dihapus
        if ($tugasAkhir->dokumen_proposal && $tugasAkhir->dokumen_proposal != '-') {
            $filePath = storage_path('app/public/dokumen/mahasiswa/' . $tugasAkhir->dokumen_proposal);

            // Cek apakah file ada dan coba hapus
            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    // Jika penghapusan file gagal, beri umpan balik kepada pengguna
                    return redirect('admin/tugasakhir')->with('error', 'Gagal menghapus file terkait.');
                }
            } else {
                return redirect('admin/tugasakhir')->with('error', 'File tidak ditemukan.');
            }
        }

        $data->delete();

        return redirect('/admin/tugasakhir')->with('success', 'Proposal berhasil dihapus.');
    }

    public function mulaiReview($id, Request $request)
    {
        $validatedData = $request->validate([
            'status_usulan' => 'required|in:0,1,2,3,4,5',
        ]);

        $tugasAkhir = TugasAkhir::find($id);

        $tugasAkhir->status_usulan = $validatedData['status_usulan'];
        $tugasAkhir->save();

        return redirect('/admin/tugasakhir/detail/' . $tugasAkhir->id)
            ->with('success', 'Status berhasil diperbarui');
    }

    public function reviewview(TugasAkhir $tugasAkhir, $id)
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasAkhir = TugasAkhir::find($id);
        $dosen = Dosen::all();
        return view('admin.pages.tugasakhir.reviewta', [
            'tugasAkhir' => $tugasAkhir,
            'mahasiswa' => $mahasiswa,
            'dosen' => $dosen,
        ]);
    }

    public function reviewpost(Request $request, $id)
    {
        $tugasAkhir = TugasAkhir::find($id);
        $validatedData = $request->validate([
            'pilihjudul' => 'nullable|max:255',
            'pembimbing1' => 'required|max:255',
            'pembimbing2' => 'required|max:255',
            'reviewta' => 'nullable',
            'hasil' => 'required'
        ]);

        // DITERIMA
        if ($validatedData['hasil'] == '1') {
            $validatedData['status_usulan'] = '1';
        }
        // REVISI
        elseif ($validatedData['hasil'] == '2') {
            $validatedData['status_usulan'] = '2';
        }
        // DITOLAK
        elseif ($validatedData['hasil'] == '3') {
            $validatedData['status_usulan'] = '3';
        }
        $tambahdata = $tugasAkhir->update($validatedData);
        if (!$tambahdata) {
            return redirect('admin/tugasakhir/review/' . $tugasAkhir->id)->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('/admin/tugasakhir/detail/' . $tugasAkhir->id)->with('success', 'Mahasiswa updated successfully');
    }
}
