@extends('admin.layouts.template')

@section('main')
    <div class="card m-3 p-4 shadow-sm">
        @if ($dosen->pembimbingta1)
            <div class="mb-4">
                <button class="btn btn-outline-primary col-1 d-inline-block" onclick="window.history.back()"
                    style="width:auto;"><i class="fas fa-arrow-left"></i> Kembali
                </button>
            </div>
        @else
            <div class="mb-4">
                <a href="/admin/dosen" class="btn btn-outline-primary col-1 d-inline-block" style="width:auto;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        @endif


        <h2 class="mb-4 text-center">Detail Dosen</h2>

        <div class="row">
            <div class="col-md-3 text-center">
                <div class="mb-3">
                    @if ($dosen->foto == '-')
                        <img src="{{ asset('images/defaultfoto.png') }}?{{ time() }}" alt="Foto Dosen"
                            class="img-fluid rounded" style="max-width: 300px; height: auto;">
                    @else
                        <img src="{{ asset('storage/' . $dosen->foto) }}?{{ time() }}" alt="Foto Dosen"
                            class="img-fluid rounded" style="max-width: 300px; height: auto;">
                    @endif
                </div>
                <div class="mb-3">
                    <label for="bidangdosen">Bidang Keahlian :</label>
                    <br>
                    @if ($dosen->bidangs->isEmpty())
                        <span class="text-muted">Belum ada bidang</span>
                    @else
                        @foreach ($dosen->bidangs as $bidang)
                            {{-- {{ $bidang->namabidang }}{{ !$loop->last ? ',' : '' }} --}}
                            <span class="badge bg-primary p-2">{{ $bidang->namabidang }}</span>
                        @endforeach
                    @endif
                </div>

                @if (Auth::user()->cannot('isMahasiswa') || Gate::allows('isAdmin') || Gate::allows('isSuperAdmin'))
                    <div class="mb-3">
                        <a href="/admin/dosen/{{ $dosen->id }}/edit" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Data
                        </a>
                    </div>
                @endif

            </div>
            <div class="col-md-9">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th scope="row" style="width: auto;">Nama</th>
                            <td>{{ $dosen->namadosen ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">NIDN</th>
                            <td><strong>{{ $dosen->nidn ?? 'Data tidak tersedia' }}</strong></td>
                        </tr>
                        <tr>
                            <th scope="row">NIP</th>
                            <td><strong>{{ $dosen->nip ?? 'Data tidak tersedia' }}</strong></td>
                        </tr>
                        <tr>
                            <th scope="row">Tempat / Tanggal Lahir</th>
                            <td>{{ $dosen->tmpt_tgl_lahir ?? 'Data tidak tersedia' }} /
                                {{ \Carbon\Carbon::parse($dosen->tgl_lahir)->format('d-m-Y') ?? 'Data tidak tersedia' }}
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td>{{ $dosen->jeniskelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Email</th>
                            <td>{{ $dosen->email ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">No Handphone</th>
                            <td>{{ $dosen->no_hp ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat</th>
                            <td>{{ $dosen->alamat ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Jurusan</th>
                            <td>{{ $dosen->jurusan->namajurusan ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Prodi</th>
                            <td>{{ $dosen->prodi->namajenjang ?? 'Data tidak tersedia' }}
                                {{ $dosen->prodi->namaprodi ?? 'Data tidak tersedia' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
