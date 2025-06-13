@extends('admin.layouts.template')

@section('main')
    <div class="card m-3 p-4 shadow-sm">

        <div class="mb-4">
            <a href="/admin/mahasiswa" class="btn btn-outline-primary col-1 d-inline-block" style="width:auto;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <h2 class="mb-4 text-center">Detail Mahasiswa</h2>

        <div class="row">
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    @if ($mahasiswa->foto == '-' || $mahasiswa->foto == null)
                        <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}" alt="Foto Mahasiswa"
                            class="img-fluid rounded" style="max-width: 300px; height: auto;">
                    @else
                        <img src="{{ asset('storage/' . $mahasiswa->foto) }}?{{ time() }}" alt="Foto Mahasiswa"
                            class="img-fluid rounded" style="max-width: 300px; height: auto;">
                    @endif
                </div>
                <div class="mb-3">
                    <a href="/admin/mahasiswa/{{ $mahasiswa->id }}/edit" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Data
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 150px;">Nama</th>
                            <td>{{ $mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">NIM</th>
                            <td><strong>{{ $mahasiswa->nim ?? 'Data tidak tersedia' }}</strong></td>
                        </tr>
                        <tr>
                            <th scope="row">Kelas</th>
                            <td><strong>{{ $mahasiswa->kelas ?? 'Data tidak tersedia' }}</strong></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td>{{ $mahasiswa->jeniskelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $mahasiswa->email ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jurusan</th>
                            <td>{{ $mahasiswa->jurusan->namajurusan ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Prodi</th>
                            <td>{{ $mahasiswa->prodi->namajenjang ?? 'Data tidak tersedia' }}
                                {{ $mahasiswa->prodi->namaprodi ?? 'Data tidak tersedia' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
