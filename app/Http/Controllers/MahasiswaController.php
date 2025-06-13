<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function index()
    {
        $data = Mahasiswa::all();
        return view('admin.pages.mahasiswa.mahasiswa', ['data' => $data]);
    }

    public function detail(mahasiswa $mahasiswa, $id)
    {
        $mahasiswa = mahasiswa::find($id);
        return view('admin.pages.mahasiswa.mahasiswadetail', ['mahasiswa' => $mahasiswa]);
    }

    public function create()
    {
        $data = Mahasiswa::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        return view('admin.pages.mahasiswa.mahasiswacreate', [
            'data' => $data,
            'jurusan' => $jurusan,
            'prodi' => $prodi
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namamhs' => 'required|max:255',
            'nim' => 'required|unique:mahasiswas,nim|max:255',
            'kelas' => 'required|max:255',
            'jeniskelamin' => 'required',
            'email' => 'required|email|unique:mahasiswas,email|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id_prodi',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);
        if ($request->file('foto')) {
            // Mengganti spasi dengan underscore (_) pada nama mahasiswa untuk nama file
            $namaFile = str_replace(' ', '_', $validatedData['namamhs']);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $namaFileBaru = $namaFile . '.' . $extension;

            // Simpan file di direktori public/images/mahasiswa
            $path = $request->file('foto')->storeAs('images/mahasiswa', $namaFileBaru, 'public');
            $validatedData['foto'] = $path;
        } else {
            $validatedData['foto'] = "-";
        }

        $tambahdata = Mahasiswa::create($validatedData);

        if (!$tambahdata) {
            return redirect('admin/mahasiswa')->with('Failed', 'Data gagal ditambahkan');
        }
        return redirect('admin/mahasiswa')->with('success', 'Data created successfully');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $data = Mahasiswa::all();
        $jurusan = Jurusan::all();
        $prodi = Prodi::all();
        return view('admin.pages.mahasiswa.mahasiswaedit', [
            'data' => $data,
            'mahasiswa' => $mahasiswa,
            'jurusan' => $jurusan,
            'prodi' => $prodi
        ]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'namamhs' => 'required|max:255',
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'kelas' => 'required',
            'jeniskelamin' => 'required',
            'email' => 'required|email|unique:mahasiswas,email,' . $mahasiswa->id,
            'jurusan_id' => 'required|exists:jurusans,id',
            'prodi_id' => 'required|exists:prodis,id_prodi',
            'foto' => 'nullable|mimes:jpg,jpeg,png|max:2048'  // Hanya menerima jpg, jpeg, png, dan ukuran maksimal 2MB
        ]);

        if ($request->file('foto')) {
            dd(0);
            // Hapus file foto lama jika ada
            if ($mahasiswa->foto && $mahasiswa->foto != '-') {
                $path = storage_path('app/public/' . $mahasiswa->foto);
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            // Ganti spasi di namamhs dengan underscore (_) dan simpan nama file baru
            $namaFile = str_replace(' ', '_', $validatedData['namamhs']);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $namaFileBaru = $namaFile . '.' . $extension;

            // Simpan file di direktori public/images/mahasiswa
            $path = $request->file('foto')->storeAs('images/mahasiswa', $namaFileBaru, 'public');
            $validatedData['foto'] = $path;
        } else {
            // Jika nama mahasiswa berubah, ganti nama file foto lama
            if ($validatedData['namamhs'] != $mahasiswa->namamhs && $mahasiswa->foto != '-') {
                $namaFotoLama = $mahasiswa->foto;
                $extension = pathinfo($namaFotoLama, PATHINFO_EXTENSION);

                $namaFileBaru = str_replace(' ', '_', $validatedData['namamhs']) . '.' . $extension;
                $pathFotoLama = storage_path('app/public/' . $namaFotoLama);
                $pathFotoBaru = storage_path('app/public/images/mahasiswa/' . $namaFileBaru);

                if (file_exists($pathFotoLama)) {
                    rename($pathFotoLama, $pathFotoBaru);
                    $validatedData['foto'] = 'images/mahasiswa/' . $namaFileBaru;
                } else {
                    $validatedData['foto'] = $mahasiswa->foto;
                }
            } else {
                $validatedData['foto'] = $mahasiswa->foto;
            }
        }
        $mahasiswa->update($validatedData);

        return redirect('/admin/mahasiswa/detail/' . $mahasiswa->id)->with('success', 'Mahasiswa updated successfully');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->foto && $mahasiswa->foto != '-') {
            $filePath = storage_path('app/public/images/mahasiswa/' . $mahasiswa->foto);

            // Hapus file foto jika ada
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $mahasiswa->delete();
        return redirect('admin/mahasiswa')->with('success', 'Mahasiswa deleted successfully');
    }

    public function getprodi(Request $request)
    {
        $jurusan_id = $request->jurusan_id;
        $prodi = Prodi::where('jurusan_id', $jurusan_id)->get();
        $option = "<option disabled selected>Pilih Prodi</option>";
        foreach ($prodi as $prodi) {
            $option .= "<option value='$prodi->id_prodi'>$prodi->namajenjang $prodi->namaprodi</option>";
        }
        echo $option;
    }
}
