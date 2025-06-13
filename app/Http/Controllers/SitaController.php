<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use App\Models\Sita;
use App\Models\Dosen;
use App\Models\Ruangan;
use App\Models\Mahasiswa;
use App\Models\TugasAkhir;
use Illuminate\Http\Request;
use App\Models\penilaian_sita;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SitaController extends Controller
{
    public function index()
    {
        if (Gate::allows('isMahasiswa')) {
            $cek = TugasAkhir::wherein('mahasiswa_id', Mahasiswa::where('email', Auth::user()->email)->pluck('id'))->first();

            if ($cek) {
                $datasita = Sita::where('tugasakhir_id', $cek->id)->get();
                $sita = Sita::where('tugasakhir_id', $cek->id)->orderby('updated_at', 'desc')->first();

                if (!$sita) {
                    return redirect('/dashboard')->with('failed', 'Anda belum bisa melakukan sidang tugas akhir');
                }

                if ($sita->status == 0) {
                    return redirect('/sita/create');
                }


                $psita = penilaian_sita::where('sita_id', $sita->id)->get();


                $pembimbing1 = $psita->where('jabatan', 1)->first();
                $pembimbing2 = $psita->where('jabatan', 2)->first();
                $penguji1 = $psita->where('jabatan', 3)->first();
                $penguji2 = $psita->where('jabatan', 4)->first();


                return view('admin.pages.sita.sita', compact('sita', 'pembimbing1', 'pembimbing2', 'penguji1', 'penguji2'));
            } else {
                return redirect('/dashboard')->with('failed', 'Mohon maaf, anda belum mengajukan data pra proposal ');
            }
        } elseif (Gate::allows('isDosen')) {
            $user = Auth::user();
            $dosenId = Dosen::where('email', $user->email)->pluck('id')->first();

            // $cek = tugasakhir::whereIn(
            //     'id',
            //     pembimbingta::where('pembimbing1_id', $dosenId->id)
            //         ->orWhere('pembimbing2_id', $dosenId->id)
            //         ->pluck('tugasakhir_id')
            // )->get();

            $cek = TugasAkhir::where('pembimbing1', $dosenId)->orWhere('pembimbing2', $dosenId)
                ->where('status_usulan', '1')
                ->get();

            $sita = sita::where(function ($query) use ($cek, $dosenId) {
                $query->whereIn('tugasakhir_id', $cek->pluck('id'))
                    ->orWhere('ketuasidang_id', $dosenId)
                    ->orWhere('sekretaris_id', $dosenId)
                    ->orWhere('penguji1_id', $dosenId)
                    ->orWhere('penguji2_id', $dosenId);
            })
                ->whereNot('status', 7)
                ->whereNot('ruangan_id', 0)
                ->get();

            return view('admin.pages.sita.sita', compact('sita'));
        } elseif (Gate::allows('isKaprodi')) {
            $sita = sita::where('pembimbing1_acc', 1)->where('pembimbing2_acc', 1)->where('status', '>', 1)->wherenot('status', 4)->get();
            return view('admin.pages.sita.sita', compact('sita'));
        } elseif (Gate::allows('isAdmin')) {
            $data = sita::where('deleted', 0)->get();
            return view('admin.pages.sita.sita', compact('data'));
        }
    }

    public function create()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->pluck('id')->first();
        $cek = tugasakhir::where('mahasiswa_id', $mahasiswa)->first();
        if ($cek) {
            $sita = sita::where('pembimbing1_acc', 1)->where('pembimbing2_acc', 1)->where('tugasakhir_id', $cek->id)->wherenot('status', 7)->orderby('updated_at', 'desc')->first();
            if (!$sita) {
                return back()->with('failed', 'Anda belum bisa melakukan sidang tugas akhir');
            }
        }
        return view('admin.pages.sita.sitacreate');
    }

    public function nilaisita($id)
    {
        $sita = sita::find($id);

        $user = Auth::user();
        $dosen = Dosen::where('email', $user->email)->first();

        $cek = Sita::where('tugasakhir_id', $sita->sitatugasakhir->id)->first();
        if ($cek->sitatugasakhir->pembimbing1 == $dosen->id) {
            $jabatan = 1;
        } elseif ($cek->sitatugasakhir->pembimbing2 == $dosen->id) {
            $jabatan = 2;
        } elseif ($sita->penguji1_id == $dosen->id) {
            $jabatan = 3;
        } elseif ($sita->penguji2_id == $dosen->id) {
            $jabatan = 4;
        } else {
            return back();
        }

        $penilaiansita = penilaian_sita::where('sita_id', $id)->where('jabatan', $jabatan)->first();

        return view('admin.pages.sita.penilaiansita', compact('penilaiansita', 'sita', 'jabatan'));
    }

    public function storenilaisita(Request $request, $id)
    {
        $validatedData = $request->validate([
            'jabatan' => 'required',
            'id' => 'required',
            'nl_identifikasimasalah' => 'required|numeric|min:0|max:100',
            'nl_relevansiteori' => 'required|numeric|min:0|max:100',
            'nl_metodologipenelitian' => 'required|numeric|min:0|max:100',
            'nl_hasilpembahasan' => 'required|numeric|min:0|max:100',
            'nl_kesimpulansarana' => 'required|numeric|min:0|max:100',
            'nl_bahasatatatulis' => 'required|numeric|min:0|max:100',
            'nl_sikappenampilan' => 'required|numeric|min:0|max:100',
            'nl_komunikasisistematika' => 'required|numeric|min:0|max:100',
            'nl_penguasaanmateri' => 'required|numeric|min:0|max:100',
            'nl_kesesuaianfungsi' => 'required|numeric|min:0|max:100',
            'totalnilai' => 'required|numeric|min:0|max:100',
            'komentar' => 'nullable|string|max:1000'
        ]);

        if ($validatedData['id'] == 0) {
            $tambahdata = penilaian_sita::create([
                'sita_id' => $id,
                'jabatan' => $validatedData['jabatan'],
                'nl_identifikasimasalah' => $validatedData['nl_identifikasimasalah'],
                'nl_relevansiteori' => $validatedData['nl_relevansiteori'],
                'nl_metodologipenelitian' => $validatedData['nl_metodologipenelitian'],
                'nl_hasilpembahasan' => $validatedData['nl_hasilpembahasan'],
                'nl_kesimpulansarana' => $validatedData['nl_kesimpulansarana'],
                'nl_bahasatatatulis' => $validatedData['nl_bahasatatatulis'],
                'nl_sikappenampilan' => $validatedData['nl_sikappenampilan'],
                'nl_komunikasisistematika' => $validatedData['nl_komunikasisistematika'],
                'nl_penguasaanmateri' => $validatedData['nl_penguasaanmateri'],
                'nl_kesesuaianfungsi' => $validatedData['nl_kesesuaianfungsi'],
                'totalnilai' => $validatedData['totalnilai'],
                'komentar' => $validatedData['komentar']
            ]);
        } else {
            $data = penilaian_sita::find($validatedData['id']);
            $tambahdata = $data->update($validatedData);
        }

        $sita = sita::find($id);
        $psita = penilaian_sita::where('sita_id', $id)->get();

        if ($psita->count() >= 1 && $psita->count() < 4) {
            $sita->update(['status' => 5]);
        }

        if ($psita->count() == 4) {
            $nilaipembimbing1 = $psita->where('jabatan', 1)->first();
            $nilaipembimbing2 = $psita->where('jabatan', 2)->first();
            $nilaipenguji1 = $psita->where('jabatan', 3)->first();
            $nilaipenguji2 = $psita->where('jabatan', 4)->first();



            $nilaiakhir = ($nilaipembimbing1->totalnilai + $nilaipembimbing2->totalnilai + $nilaipenguji1->totalnilai + $nilaipenguji2->totalnilai) / 4;

            if ($nilaiakhir > 70) {
                $sita->update([
                    'nilaiakhir' => $nilaiakhir,
                    'status' => 6
                ]);
            } else {
                $sita->update([
                    'nilaiakhir' => $nilaiakhir,
                    'status' => 7
                ]);
            }
        }

        if (!$tambahdata) {
            return back()->with('failed', 'Mohon maaf, anda gagal menyimpan nilai');
        }

        return back()->with('success', 'Nilai Berhasil Disimpan');
    }

    public function store(request $request)
    {
        $validatedData = $request->validate([
            'dokumen' => 'required|mimes:pdf'
        ]);

        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        $cek = tugasakhir::where('mahasiswa_id', $mahasiswa->id)->first();

        $sita = sita::where('tugasakhir_id', $cek->id)->orderby('updated_at', 'desc')->first();

        // if ($request->hasFile('dokumen')) {
        //     $ceksimilaritydatabase = SimilarityController::ceksimilarityta($validatedData['dokumen']);
        //     $ceksimilarityscholar = SimilarityController::ceksimilarityscholar($cek->judulterpilih, $validatedData['dokumen']);
        //     if (!$ceksimilaritydatabase || !$ceksimilarityscholar) {
        //         return back()->with('failed', 'Mohon maaf, laporan anda terlalu mirip dengan laporan yang sudah ada');
        //     }
        // }

        $tambahdatasita = $sita->update([
            'status' => 1,
            'deleted' => 0
        ]);

        if (!$tambahdatasita) {
            return back()->with('failed', 'Mohon maaf, data gagal diajukan');
        }

        if ($mahasiswa) {
            if ($request->hasFile('dokumen')) {
                $nim = str_replace(' ', '_', $mahasiswa->nim);
                $namaMahasiswa = str_replace(' ', '_', $mahasiswa->namamhs);
                $extension = $request->file('dokumen')->getClientOriginalExtension();

                $namaFileBaru = "{$nim}_{$namaMahasiswa}_fullta.{$extension}";

                $path = $request->file('dokumen')->storeAs('dokumen/mahasiswa', $namaFileBaru, 'public');
                $validatedData['dokumen'] = $path;
            } else {
                $validatedData['dokumen'] = '-';
            }

            $cek->update(['fullta' => $validatedData['dokumen']]);
        }
        return redirect('/sita')->with('success', 'Pengajuan Sidang anda berhasil diajukan');
    }

    public function formsitajadwal($id)
    {
        $sita = Sita::find($id);

        $user = Auth::user();
        $dosenId = Dosen::where('email', $user->email)->pluck('id')->first();
        $pembimbing1ta = TugasAkhir::where('id', $sita->sitatugasakhir->id)->pluck('pembimbing1')->first();
        $pembimbing2ta = TugasAkhir::where('id', $sita->sitatugasakhir->id)->pluck('pembimbing2')->first();


        // $pembimbingta = pembimbingta::where('tugasakhir_id', $sita->tugasakhir_id)->first();
        $dosen = Dosen::doesntHave('pembimbingta1')
            ->doesntHave('pembimbingta2')
            ->doesntHave('pengujisempro')
            ->get();
        $ruangan = Ruangan::all();
        $sesi = Sesi::all();
        return view('admin.pages.sita.formjadwalsita', compact('sita', 'dosen', 'ruangan', 'pembimbing1ta', 'pembimbing2ta', 'sesi'));
    }

    public function storesitajadwal(Request $request, $id)
    {
        // Cari data Sita berdasarkan ID
        $sita = Sita::find($id);

        // Validasi input
        $validatedData = $request->validate([
            'ketuasidang_id' => 'required',
            'sekretaris_id' => 'required',
            'penguji1_id' => 'required',
            'penguji2_id' => 'required',
            'tgl_sita' => 'required|date|after_or_equal:today',
            'ruangan_id' => 'required|exists:ruangans,id',
            'sesi_id' => 'required|exists:sesis,id',
        ]);

        // Cek apakah sudah ada jadwal dengan ruangan dan sesi yang sama pada tanggal yang sama
        $cekSesi = Sita::where('tgl_sita', $validatedData['tgl_sita'])
            ->where('ruangan_id', $validatedData['ruangan_id'])
            ->where('sesi_id', $validatedData['sesi_id'])
            ->exists();

        if ($cekSesi) {
            return back()->with('failed', 'Ruangan dengan sesi tersebut sudah digunakan pada tanggal yang dipilih.');
        }

        // Tambahkan status ke data yang divalidasi
        $validatedData['status'] = 3;

        // Update data Sita
        $tambahdata = $sita->update($validatedData);

        // Periksa apakah update berhasil
        if (!$tambahdata) {
            return back()->with('failed', 'Mohon maaf, sidang seminar proposal gagal dijadwalkan');
        }

        // Redirect ke halaman detail dengan pesan sukses
        return redirect('/detailsita/' . $id)->with('success', 'Penjadwalan sidang proposal berhasil dijadwalkan');
    }


    public function download($id)
    {
        $data = tugasakhir::find($id);

        return response()->download(storage_path('app/public/' . $data->fullta));
    }

    public function accsidangta($id)
    {
        // $kartubimbingan = kartubimbingan::where('tugasakhir_id', $id)->where('pembimbing_id', Auth::user()->userdosen->id)->get();
        // if ($kartubimbingan->count() < 9) {
        //     return back()->with('failed', 'Mohon maaf, mahasiswa ini belum memenuhi batas minimal bimbingan');
        // }
        $ta = tugasakhir::find($id);

        $user = Auth::user();
        $dosen = Dosen::where('email', $user->email)->first();

        // $pembimbingta = pembimbingta::where('tugasakhir_id', $ta->id)->first();
        // $pembimbingta = TugasAkhir::where('pembimbing1', $dosen)->orWhere('pembimbing2', $dosen)->get();
        $pembimbing1ta = $ta->pembimbing1 == $dosen->id;
        $pembimbing2ta = $ta->pembimbing2 == $dosen->id;

        if ($pembimbing1ta) {
            $pembimbingta = 1;
        } elseif ($pembimbing2ta) {
            $pembimbingta = 2;
        } else {
            return back()->with('failed', 'Mohon maaf ada kesalahan pada sistem kami');
        }

        $cek = sita::where('tugasakhir_id', $ta->id)->wherenot('status', 7)->orderby('updated_at', 'desc')->first();
        if (!$cek) {
            if ($pembimbingta == 1) {
                $tambahdatasita = sita::create([
                    'tugasakhir_id' => $ta->id,
                    'pembimbing1_acc' => 1
                ]);
            } else {
                $tambahdatasita = sita::create([
                    'tugasakhir_id' => $ta->id,
                    'pembimbing2_acc' => 1
                ]);
            }
        } else {
            if ($pembimbingta == 1) {
                $tambahdatasita = $cek->update([
                    'pembimbing1_acc' => 1
                ]);
            } else {
                $tambahdatasita = $cek->update([
                    'pembimbing2_acc' => 1
                ]);
            }
        }
        if (!$tambahdatasita) {
            return back()->with('failed', 'Mohon maaf, ada kesalahan pada sistem kami');
        }

        return back()->with('success', 'Data berhasil Di acc');
    }

    public function detail($id)
    {
        $sita = Sita::find($id);
        $user = Auth::user();
        $dosenId = Dosen::where('email', $user->email)->pluck('id')->first();
        $mahasiswaId = Mahasiswa::where('email', $user->email)->pluck('id')->first();
        if (Carbon::now('Asia/Jakarta')->diffInDays($sita->tgl_sita) < 1) {
            $edit = 0;
        } else {
            $edit = 1;
        }


        return view('admin.pages.sita.sitadetail', compact('sita', 'edit', 'dosenId', 'mahasiswaId'));
    }

    public function validasidokumen($id)
    {
        $sita = sita::find($id);

        $validasi = $sita->update(['status' => 2]);
        if (!$validasi) {
            return back()->with('failed', 'Dokumen gagal di validasi');
        }


        return back()->with('success', 'Dokumen sukses di validasi');
    }

    public function tolakvalidasidokumen($id)
    {
        $sita = sita::find($id);


        $validasi = $sita->update(['deleted' => 1]);

        // notifikasi::create([
        //     'user_id' => $sita->sitatugasakhir->mahasiswatugasakhir->user_id,
        //     'judul' => 'Pemberitahuan',
        //     'notifikasi' => 'Pengajuan sidang tugas akhir anda ditolak, silahkan lengkapi dokumen anda dan ajukan kembali'
        // ]);


        if (!$validasi) {
            return back()->with('failed', 'Pengajuan Sidang Ta gagal di tolak');
        }

        return redirect('/sita')->with('success', 'Pengajuan Sidang Ta sukses di tolak');
    }
}
