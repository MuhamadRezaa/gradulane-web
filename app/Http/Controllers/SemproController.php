<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Dosen;
use App\Models\Sempro;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use App\Models\penilaian_sempro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SemproController extends Controller
{
    public function index()
    {
        if (Gate::allows('isMahasiswa')) {
            $data = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
                ->where('status_usulan', '1')
                ->get();

            $dataSempro = Sempro::whereIn('tugasakhir_id', $data->pluck('id'))->get();

            $psempro = penilaian_sempro::whereIn('sempro_id', $dataSempro->pluck('id'))->get();

            $pembimbing1 = $psempro->where('jabatan', 1)->first();
            $pembimbing2 = $psempro->where('jabatan', 2)->first();
            $penguji = $psempro->where('jabatan', 3)->first();

            return view('admin.pages.sempro.sempro', ['data' => $data, 'dataSempro' => $dataSempro, 'psempro' => $psempro, 'pembimbing1' => $pembimbing1, 'pembimbing2' => $pembimbing2, 'penguji' => $penguji]);
        } elseif (Gate::allows('isDosen')) {
            $pembimbingId = Dosen::where('email', Auth::user()->email)->pluck('id')->first();

            $data = TugasAkhir::where('pembimbing1', $pembimbingId)->orWhere('pembimbing2', $pembimbingId)
                ->where('status_usulan', '1')
                ->get();

            $dataSempro = Sempro::whereIn('tugasakhir_id', $data->pluck('id'))
                ->orWhere('pengujisempro_id', $pembimbingId)
                ->get();

            return view('admin.pages.sempro.sempro', [
                'data' => $data,
                'pembimbingId' => $pembimbingId,
                'dataSempro' => $dataSempro,
            ]);
        } elseif (Gate::allows('isKaprodi')) {
            $pembimbingId = Dosen::where('email', Auth::user()->email)->pluck('id')->first();

            $data = TugasAkhir::where('status_usulan', '1')->get();

            $dataSempro = Sempro::whereIn('tugasakhir_id', $data->pluck('id'))->get();

            return view('admin.pages.sempro.sempro', [
                'data' => $data,
                'pembimbingId' => $pembimbingId,
                'dataSempro' => $dataSempro,
            ]);
        }
    }

    public function detail($id)
    {
        $dataSempro = Sempro::find($id);

        $pembimbingId = Dosen::where('email', Auth::user()->email)->pluck('id')->first();

        $validasiSempro1 = Sempro::with('tugasakhir')
            ->where('tugasakhir_id', $dataSempro->tugasakhir->id)
            ->get()
            ->filter(function ($sempro) use ($pembimbingId) {
                return $sempro->tugasakhir->pembimbing1 == $pembimbingId;
            });

        $validasiSempro2 = Sempro::with('tugasakhir')
            ->where('tugasakhir_id', $dataSempro->tugasakhir->id)
            ->get()
            ->filter(function ($sempro) use ($pembimbingId) {
                return $sempro->tugasakhir->pembimbing2 == $pembimbingId;
            });

        return view('admin.pages.sempro.semprodetail', [
            'dataSempro' => $dataSempro,
            'validasiSempro1' => $validasiSempro1,
            'validasiSempro2' => $validasiSempro2,
            'pembimbingId' => $pembimbingId,
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasAkhir = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
            ->where('status_usulan', '1')
            ->first();

        $data = Sempro::all();

        return view('admin.pages.sempro.semprocreate', [
            'tugasAkhir' => $tugasAkhir,
            'data' => $data,
            'mahasiswa' => $mahasiswa,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tugasakhir_id' => 'required|exists:tugasakhirs,id',
            'file_sempro' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if ($mahasiswa) {

            if ($request->file('file_sempro')) {
                $nim = str_replace(' ', '_', $mahasiswa->nim);
                $namaMahasiswa = str_replace(' ', '_', $mahasiswa->namamhs);
                $extension = $request->file('file_sempro')->getClientOriginalExtension();

                $namaFileBaru = "{$nim}_{$namaMahasiswa}_sempro.{$extension}";

                $path = $request->file('file_sempro')->storeAs('dokumen/mahasiswa', $namaFileBaru, 'public');
                $validatedData['file_sempro'] = $path;
            }

            $validatedData['status_sempro'] = '0';
            $tambahdata = Sempro::create($validatedData);
            if (!$tambahdata) {
                return redirect('admin/sempro')->with('Failed', 'Data gagal ditambahkan');
            }
            return redirect('admin/sempro')->with('success', 'Data created successfully');
        } else {
            return redirect('admin/sempro/create')->with('Failed', 'Mahasiswa tidak ditemukan');
        }
    }

    public function edit($id)
    {
        $sempro = Sempro::findOrFail($id);
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
        $tugasAkhir = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))
            ->where('status_usulan', '1')
            ->first();

        return view('admin.pages.sempro.semproedit', [
            'sempro' => $sempro,
            'tugasAkhir' => $tugasAkhir,
            'mahasiswa' => $mahasiswa,
        ]);
    }


    public function update(Request $request, $id)
    {
        $sempro = Sempro::findOrFail($id);

        $validatedData = $request->validate([
            'tugasakhir_id' => 'required|exists:tugasakhirs,id',
            'file_sempro' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if ($mahasiswa) {
            if ($request->hasFile('file_sempro')) {
                // Hapus file lama jika ada
                if ($sempro->file_sempro) {
                    Storage::disk('public')->delete($sempro->file_sempro);
                }

                $nim = str_replace(' ', '_', $mahasiswa->nim);
                $namaMahasiswa = str_replace(' ', '_', $mahasiswa->namamhs);
                $extension = $request->file('file_sempro')->getClientOriginalExtension();

                $namaFileBaru = "{$nim}_{$namaMahasiswa}_sempro.{$extension}";

                $path = $request->file('file_sempro')->storeAs('dokumen/mahasiswa', $namaFileBaru, 'public');
                $validatedData['file_sempro'] = $path;
            }

            $sempro->update($validatedData);

            return redirect('admin/sempro')->with('success', 'Data updated successfully');
        } else {
            return redirect('admin/sempro')->with('Failed', 'Mahasiswa tidak ditemukan');
        }
    }


    public function destroy(Sempro $dataSempro, $id)
    {
        $data = Sempro::findOrFail($id);
        if ($dataSempro->file_sempro && $dataSempro->file_sempro != '-') {
            $filePath = storage_path('app/public/dokumen/mahasiswa/' . $dataSempro->file_sempro);

            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    return redirect('admin/sempro')->with('error', 'Gagal menghapus file terkait.');
                }
            } else {
                return redirect('admin/sempro')->with('error', 'File tidak ditemukan.');
            }
        }

        $data->delete();

        return redirect('/admin/sempro')->with('success', 'Pengajuan sempro berhasil dihapus.');
    }


    public function validasisemprop1(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pembimbing1_acc' => 'required|boolean',
        ]);

        $sempro = Sempro::findOrFail($id);

        $sempro->pembimbing1_acc = $validatedData['pembimbing1_acc'];
        $sempro->status_sempro = $validatedData['status_sempro'] = '1';
        $sempro->save();

        return redirect()->back()->with('success', 'Seminar Proposal Mahasiswa berhasil divalidasi!');
    }

    public function validasisemprop2(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pembimbing2_acc' => 'required|boolean',
        ]);

        $sempro = Sempro::findOrFail($id);

        $sempro->pembimbing2_acc = $validatedData['pembimbing2_acc'];
        $sempro->status_sempro = $validatedData['status_sempro'] = '1';
        $sempro->save();

        return redirect()->back()->with('success', 'Seminar Proposal Mahasiswa berhasil divalidasi!');
    }

    public function penjadwalansempro($id)
    {
        $sempro = Sempro::findOrFail($id);
        $tugasAkhir = DB::table('tugasakhirs')
            ->where('id', $sempro->tugasakhir->id)
            ->select(['pembimbing1', 'pembimbing2'])
            ->first();

        $ambilId = collect([$tugasAkhir->pembimbing1, $tugasAkhir->pembimbing2])->filter();

        $dosen = Dosen::whereNotIn('id', $ambilId)->get();

        $ruangan = Ruangan::get();
        $sesi = Sesi::get();
        return view('admin.pages.sempro.jadwalsemprocreate', [
            'sempro' => $sempro,
            'dosen' => $dosen,
            'ruangan' => $ruangan,
            'sesi' => $sesi,
        ]);
    }

    public function storepenjadwalansempro(Request $request)
    {
        $validatedData = $request->validate([
            'pengujisempro_id' => 'required|exists:dosens,id',
            'tgl_sempro' => 'required|date|after_or_equal:today',
            'ruangan_id' => 'required|exists:ruangans,id',
            'sesi_id' => 'required|exists:sesis,id',
        ]);

        // Cek apakah sudah ada jadwal di tanggal, ruangan, dan sesi yang sama
        $cekRuangan = Sempro::where('tgl_sempro', $validatedData['tgl_sempro'])
            ->where('ruangan_id', $validatedData['ruangan_id'])
            ->where('sesi_id', $validatedData['sesi_id'])
            ->exists();

        if ($cekRuangan) {
            return redirect()->back()->with('failed', 'Jadwal pada sesi yang dipilih untuk tanggal dan ruangan tersebut sudah ada!');
        }

        // Ambil data sempro berdasarkan ID
        $sempro = Sempro::findOrFail($request->id);

        // Simpan data penjadwalan seminar proposal
        $sempro->update([
            'pengujisempro_id' => $validatedData['pengujisempro_id'],
            'tgl_sempro' => $validatedData['tgl_sempro'],
            'ruangan_id' => $validatedData['ruangan_id'],
            'sesi_id' => $validatedData['sesi_id'],
        ]);

        // Perbarui status sempro
        $sempro->status_sempro = '2';
        $sempro->save();

        // Redirect ke halaman sempro detail setelah data disimpan
        return redirect('/admin/sempro/detail/' . $sempro->id)->with('success', 'Penjadwalan Seminar Proposal berhasil.');
    }

    public function editpenjadwalansempro($id)
    {
        $sempro = Sempro::findOrFail($id);
        $tugasAkhir = DB::table('tugasakhirs')
            ->where('id', $sempro->tugasakhir->id)
            ->select(['pembimbing1', 'pembimbing2'])
            ->first();

        $ambilId = collect([$tugasAkhir->pembimbing1, $tugasAkhir->pembimbing2])->filter();

        $dosen = Dosen::whereNotIn('id', $ambilId)->get();

        $ruangan = Ruangan::get();
        $sesi = Sesi::get();
        return view('admin.pages.sempro.jadwalsemproedit', [
            'sempro' => $sempro,
            'dosen' => $dosen,
            'ruangan' => $ruangan,
            'sesi' => $sesi,
        ]);
    }

    public function updatepenjadwalansempro(Request $request, $id)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'pengujisempro_id' => 'required|exists:dosens,id',
            'tgl_sempro' => 'required|date|after_or_equal:today',
            'ruangan_id' => 'required|exists:ruangans,id',
            'sesi_id' => 'required|exists:sesis,id',
        ]);

        // Cek apakah sudah ada jadwal di tanggal, ruangan, dan sesi yang sama
        $existingSempro = Sempro::where('tgl_sempro', $validatedData['tgl_sempro'])
            ->where('ruangan_id', $validatedData['ruangan_id'])
            ->where('sesi_id', $validatedData['sesi_id'])
            ->where('id', '!=', $id) // Menghindari bentrok dengan data yang sedang diperbarui
            ->exists();

        if ($existingSempro) {
            // Jika terjadi konflik jadwal, kembalikan dengan pesan error menggunakan SweetAlert2
            return redirect()->back()->with('failed', 'Jadwal pada sesi yang dipilih untuk tanggal dan ruangan tersebut sudah ada!');
        }

        // Ambil data sempro berdasarkan ID
        $sempro = Sempro::findOrFail($id);

        // Update data penjadwalan seminar proposal
        $sempro->update([
            'pengujisempro_id' => $validatedData['pengujisempro_id'],
            'tgl_sempro' => $validatedData['tgl_sempro'],
            'ruangan_id' => $validatedData['ruangan_id'],
            'sesi_id' => $validatedData['sesi_id'],
        ]);

        // Redirect ke halaman detail setelah berhasil update
        return redirect('/admin/sempro/detail/' . $sempro->id)->with('success', 'Penjadwalan Seminar Proposal berhasil diperbarui.');
    }

    public function penilaiansempro($id)
    {
        $sempro = sempro::find($id);

        $user = Auth::user();
        $dosen = Dosen::where('email', $user->email)->first();

        $cek = Sempro::where('tugasakhir_id', $sempro->tugasakhir->id)->first();
        if ($cek->tugasakhir->pembimbing1 == $dosen->id) {
            $jabatan = 1;
        } elseif ($cek->tugasakhir->pembimbing2 == $dosen->id) {
            $jabatan = 2;
        } elseif ($sempro->pengujisempro_id == $dosen->id) {
            $jabatan = 3;
        } else {
            return back();
        }

        $penilaiansempro = penilaian_sempro::where('sempro_id', $id)->where('jabatan', $jabatan)->first();

        return view('admin.pages.sempro.penilaiansempro', compact('penilaiansempro', 'sempro', 'jabatan'));
    }

    public function storenilaisempro(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jabatan' => 'required',
            'id' => 'required',
            'nl_pendahuluan' => 'required|numeric|min:0|max:100',
            'nl_tinjauanpustaka' => 'required|numeric|min:0|max:100',
            'nl_metodologipenelitian' => 'required|numeric|min:0|max:100',
            'nl_bahasadantatatulis' => 'required|numeric|min:0|max:100',
            'nl_presentasi' => 'required|numeric|min:0|max:100',
            'ratarata' => 'required|numeric|min:0|max:100',
            'komentar' => 'nullable|string|max:1000'
        ]);

        if ($validatedData['id'] == 0) {
            $tambahdata = penilaian_sempro::create([
                'sempro_id' => $id,
                'jabatan' => $validatedData['jabatan'],
                'nl_pendahuluan' => $validatedData['nl_pendahuluan'],
                'nl_tinjauanpustaka' => $validatedData['nl_tinjauanpustaka'],
                'nl_metodologipenelitian' => $validatedData['nl_metodologipenelitian'],
                'nl_bahasadantatatulis' => $validatedData['nl_bahasadantatatulis'],
                'nl_presentasi' => $validatedData['nl_presentasi'],
                'ratarata' => $validatedData['ratarata'],
                'komentar' => $validatedData['komentar']
            ]);
        } else {
            $data = penilaian_sempro::find($validatedData['id']);
            $tambahdata = $data->update($validatedData);
        }
        $sempro = sempro::find($id);
        $psempro = penilaian_sempro::where('sempro_id', $id)->get();

        if ($psempro->count() >= 1 && $psempro->count() < 3) {
            $sempro->update(['status_sempro' => 3]);
        }

        if ($psempro->count() == 3) {
            $nilaipembimbing1 = $psempro->where('jabatan', 1)->first();
            $nilaipembimbing2 = $psempro->where('jabatan', 2)->first();
            $nilaipenguji = $psempro->where('jabatan', 3)->first();

            $rataratanilaipembimbing = (
                (
                    ($nilaipembimbing1->nl_pendahuluan ?? 0) +
                    ($nilaipembimbing1->nl_tinjauanpustaka ?? 0) +
                    ($nilaipembimbing1->nl_metodologipenelitian ?? 0) +
                    ($nilaipembimbing1->nl_bahasadantatatulis ?? 0) +
                    ($nilaipembimbing1->nl_presentasi ?? 0) +
                    ($nilaipembimbing2->nl_pendahuluan ?? 0) +
                    ($nilaipembimbing2->nl_tinjauanpustaka ?? 0) +
                    ($nilaipembimbing2->nl_metodologipenelitian ?? 0) +
                    ($nilaipembimbing2->nl_bahasadantatatulis ?? 0) +
                    ($nilaipembimbing2->nl_presentasi ?? 0)
                ) / 10
            ) * 0.6;

            $rataratanilaipenguji = (
                (
                    ($nilaipenguji->nl_pendahuluan ?? 0) +
                    ($nilaipenguji->nl_tinjauanpustaka ?? 0) +
                    ($nilaipenguji->nl_metodologipenelitian ?? 0) +
                    ($nilaipenguji->nl_bahasadantatatulis ?? 0) +
                    ($nilaipenguji->nl_presentasi ?? 0)

                ) / 5
            ) * 0.4;

            $nilaiakhir = $rataratanilaipembimbing + $rataratanilaipenguji;

            if ($nilaiakhir > 70) {
                $sempro->nilaiakhir = $nilaiakhir;
                $sempro->status_sempro = $validatedData['status_sempro'] = '4';
                $sempro->save();
                // $sempro->update([
                //     'nilaiakhir' => $nilaiakhir,
                //     'status_sempro' => 4
                // ]);
            } else {
                $sempro->nilaiakhir = $nilaiakhir;
                $sempro->status_sempro = $validatedData['status_sempro'] = '5';
                $sempro->save();
                // $sempro->update([
                //     'nilaiakhir' => $nilaiakhir,
                //     'status_sempro' => 5
                // ]);
            }
        }

        if (!$tambahdata) {
            return back()->with('failed', 'Mohon maaf, anda gagal menyimpan nilai');
        }
        return back()->with('success', 'Nilai Berhasil Disimpan');
    }
}
