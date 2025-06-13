<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Prodi;
use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Jurusan;
use App\Models\Bidangdosen;
use Illuminate\Http\Request;
use App\Models\Jabatanfungsional;
use App\Models\TugasAkhir;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index()
    {
        $data = Dosen::all();
        return view('admin.pages.dosen.dosen', ['data' => $data]);
    }

    public function detail(dosen $dosen, $id)
    {
        $dosen = dosen::find($id);
        $bidang = Bidang::all();
        $bidangdosen = Bidangdosen::all();
        return view('admin.pages.dosen.dosendetail', [
            'dosen' => $dosen,
            'bidang' => $bidang,
            'bidangdosen' => $bidangdosen,
        ]);
    }

    public function create()
    {
        $data = Dosen::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $jabatan = jabatan::all();
        $jabatanfungsional = jabatanfungsional::all();
        return view('admin.pages.dosen.dosencreate', [
            'data' => $data,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'jabatan' => $jabatan,
            'jabatanfungsional' => $jabatanfungsional
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namadosen' => 'required|max:255',
            'nidn' => 'required|unique:dosens,nidn|max:100',
            'nip' => 'required|unique:dosens,nip|max:100',
            'tmpt_tgl_lahir' => 'required|max:255',
            'tgl' => 'required',
            'bln' => 'required',
            'thn' => 'required',
            'jeniskelamin' => 'required',
            'email' => 'required|email|unique:dosens,email|max:255',
            'no_hp' => 'required|unique:dosens,no_hp|max:50',
            'alamat' => 'required|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id_prodi',
            'jabatan_id' => 'required|exists:jabatans,id_jabatan',
            'jabatanfungsional_id' => 'required|exists:jabatanfungsionals,id',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);

        $tanggalLahir = sprintf('%04d-%02d-%02d', $validatedData['thn'], $validatedData['bln'], $validatedData['tgl']);

        // Upload foto jika ada file yang diupload
        if ($request->file('foto')) {
            // Mengganti spasi dengan underscore (_) pada nama mahasiswa untuk nama file
            $namaFile = str_replace(' ', '_', $validatedData['namadosen']);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $namaFileBaru = $namaFile . '.' . $extension;

            // Simpan file di direktori public/images/mahasiswa
            $path = $request->file('foto')->storeAs('images/dosen', $namaFileBaru, 'public');
            $validatedData['foto'] = $path;
        } else {
            $validatedData['foto'] = "-";
        }
        $validatedData['tgl_lahir'] = $tanggalLahir;
        $tambahdata = Dosen::create($validatedData);
        if (!$tambahdata) {
            return redirect('admin/dosen')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/dosen')->with('success', 'Data created successfully');
    }

    public function edit(Dosen $dosen)
    {
        $data = Dosen::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        $jabatan = jabatan::all();
        $jabatanfungsional = jabatanfungsional::all();
        return view('admin.pages.dosen.dosenedit', [
            'data' => $data,
            'dosen' => $dosen,
            'jurusan' => $jurusan,
            'prodi' => $prodi,
            'jabatan' => $jabatan,
            'jabatanfungsional' => $jabatanfungsional
        ]);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validatedData = $request->validate([
            'namadosen' => 'required|max:255',
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id . '|max:100',
            'nip' => 'required|unique:dosens,nip,' . $dosen->id . '|max:100',
            'tmpt_tgl_lahir' => 'required|max:255',
            'tgl' => 'required',
            'bln' => 'required',
            'thn' => 'required',
            'jeniskelamin' => 'required',
            'email' => 'required|email|max:255|unique:dosens,email,' . $dosen->id,
            'no_hp' => 'required|max:50|unique:dosens,no_hp,' . $dosen->id,
            'alamat' => 'required|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id_prodi',
            'jabatan_id' => 'required|exists:jabatans,id_jabatan',
            'jabatanfungsional_id' => 'required|exists:jabatanfungsionals,id',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);
        $tanggalLahir = sprintf('%04d-%02d-%02d', $validatedData['thn'], $validatedData['bln'], $validatedData['tgl']);
        // Upload foto jika ada file yang diupload
        if ($request->file('foto')) {
            // Hapus file foto lama jika ada
            if ($dosen->foto && $dosen->foto != '-') {
                $path = storage_path('app/public/' . $dosen->foto);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Ganti spasi di namadosen dengan underscore (_) dan simpan nama file baru
            $namaFile = str_replace(' ', '_', $validatedData['namadosen']);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $namaFileBaru = $namaFile . '.' . $extension;

            // Simpan file di direktori public/images/dosen
            $path = $request->file('foto')->storeAs('images/dosen', $namaFileBaru, 'public');
            $validatedData['foto'] = $path;
        } else {
            // Jika nama dosen berubah, ganti nama file foto lama
            if ($validatedData['namadosen'] != $dosen->namadosen && $dosen->foto != '-') {
                $namaFotoLama = $dosen->foto;
                $extension = pathinfo($namaFotoLama, PATHINFO_EXTENSION);

                $namaFileBaru = str_replace(' ', '_', $validatedData['namadosen']) . '.' . $extension;
                $pathFotoLama = storage_path('app/public/' . $namaFotoLama);
                $pathFotoBaru = storage_path('app/public/images/dosen/' . $namaFileBaru);

                if (file_exists($pathFotoLama)) {
                    rename($pathFotoLama, $pathFotoBaru);
                    $validatedData['foto'] = 'images/dosen/' . $namaFileBaru;
                } else {
                    $validatedData['foto'] = $dosen->foto;
                }
            } else {
                $validatedData['foto'] = $dosen->foto;
            }
        }

        // Update data dosen
        $validatedData['tgl_lahir'] = $tanggalLahir;
        $dosen->update($validatedData);

        return redirect('/admin/dosen/detail/' . $dosen->id)->with('success', 'Dosen updated successfully');
    }


    public function destroy(Dosen $dosen)
    {
        // Hapus foto jika ada
        if ($dosen->foto && $dosen->foto != '-') {
            $filePath = storage_path('app/public/images/dosen/' . $dosen->foto);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $dosen->delete();
        return redirect('admin/dosen')->with('success', 'Dosen deleted successfully');
    }
}
