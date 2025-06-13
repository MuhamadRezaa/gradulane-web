@extends('admin.layouts.template')

<style>
    .pembimbing-menu {
        background-color: #f8f9fad2;
        /* Warna latar belakang default */
        border: 1px solid #dee2e6;
        /* Border default */
        border-radius: 8px 8px 0 0;
        /* Sudut melengkung */
        transition: background-color 0.3s, transform 0.3s;
        /* Transisi halus untuk background dan transform */
        padding: 10px;
        /* Padding untuk menu */
        text-align: center;
        /* Pusatkan teks */
        color: #7e7e7e;
        /* Warna teks default */
        text-decoration: none;
        /* Menghilangkan garis bawah pada teks */
        transform: scale(0.95);
        /* Kecilkan ukuran menu yang tidak aktif */
    }

    .pembimbing-menu:hover {
        text-decoration: none;
        /* Menghilangkan garis bawah saat hover */
        color: black;
        /* Ubah warna teks saat hover */
        background: rgb(255, 255, 255);
        /* Ubah warna latar belakang saat hover */
        transform: scale(1);
        /* Kembalikan ukuran saat hover */
    }

    .pembimbing-menu.active {
        background-color: #ffffff;
        /* Warna latar belakang saat aktif */
        color: black;
        /* Warna teks saat aktif */
        border-bottom: none;
        /* Menghilangkan border bawah saat aktif */
        margin-bottom: 1px;
        /* Jarak bawah */
        box-shadow: none;
        /* Hilangkan bayangan saat aktif */
        transform: scale(1);
        /* Ukuran normal saat aktif */
    }

    .pembimbing-detail {
        display: block;
        /* Tampilkan konten */
    }

    .hidden {
        display: none;
        /* Kelas untuk menyembunyikan elemen */
    }
</style>

@section('main')
    @if (Gate::allows('isMahasiswa'))
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card p-4 shadow-sm">
                    <div class="mb-4">
                        <a href="/admin/bimbingan" class="btn btn-outline-primary d-inline-block" style="width:auto;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="text-center">
                        <div class="mb-3">
                            @if ($bimbingan->mahasiswa->foto == '-')
                                <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                    alt="Foto Mahasiswa" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                            @else
                                <img src="{{ asset('storage/' . $bimbingan->mahasiswa->foto) }}?{{ time() }}"
                                    alt="Foto Dosen" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                    </div>
                    <table class="table mb-4 table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">NIM</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->nim ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jurusan</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->jurusan->namajurusan ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Program Studi</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->prodi->namajenjang ?? 'Data tidak tersedia' }}
                                    {{ $bimbingan->mahasiswa->prodi->namaprodi ?? 'Data tidak tersedia' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th scope="row" colspan="2">Judul Tugas Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td><strong>{{ $bimbingan->pilihjudul ?? 'Data tidak tersedia' }}</strong></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="col-lg-8">
                <a class="pembimbing-menu d-inline-block p-2 active" href="#" id="bimbinganpembimbing1">Pembimbing
                    1</a>
                <a class="pembimbing-menu d-inline-block p-2" href="#" id="bimbinganpembimbing2"
                    style="margin-left: -7px">Pembimbing 2</a>

                <div class="pembimbing-content card p-4 shadow-sm" style="border-top: none; border-radius: 0 8px 8px 8px;">

                    <!-- Konten untuk Pembimbing 1 -->
                    <div id="content-pembimbing1" class="pembimbing-detail">
                        <div class="row mb-3 align-items-center">
                            <div class="col-auto">
                                @if ($bimbingan->pembimbingta1->foto == '-')
                                    <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                        alt="Foto Mahasiswa" class="img-fluid rounded"
                                        style="max-width: 60px; height: 60px;">
                                @else
                                    <img src="{{ asset('storage/' . $bimbingan->pembimbingta1->foto) }}?{{ time() }}"
                                        alt="Foto Mahasiswa" class="img-fluid rounded"
                                        style="max-width: 60px; height: 60px;">
                                @endif
                            </div>
                            <div class="col-auto">
                                <h5 class="mb-0"><a href="#"
                                        class="text-decoration-none text-dark">{{ $bimbingan->pembimbingta1->namadosen }}</a>
                                </h5>
                                <span class="text-muted">Pembimbing Satu</span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="sidebar-divider" style="border-color: #7e7e7e">

                        <div>
                            <a href="/admin/bimbingan/pembahasanp1" class="btn btn-primary my-3 col-auto ">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pembahasan</th>
                                    <th>Tanggal Bimbingan</th>
                                    <th>Validasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPembimbing1 as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ Str::limit($item->pembahasan, 50, '...') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if ($item->verifikasibimbingan == '0')
                                                <span class="badge bg-secondary p-2">Belum</span>
                                            @else
                                                <span class="badge bg-success p-2">Sudah</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary detail-btn"
                                                href="/admin/detail/bimbingan/{{ $item->id }}" data-toggle="modal"
                                                data-target="#detailModal"
                                                data-tglbimbingan="{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}"
                                                data-pembahasan="{{ $item->pembahasan }}">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>

                                            <input type="hidden" class="edit-url"
                                                value="/admin/bimbingan/editpembahasanp1/{{ $item->id }}">
                                            {{-- <a href="/admin/bimbingan/editpembahasanp1/{{ $item->id }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a> --}}
                                            @if ($item->verifikasibimbingan == '0')
                                                <form action="/admin/bimbingan/{{ $item->id }}" method="post"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger delete-btn"><i
                                                            class="fas fa-trash-alt"></i> Remove</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Konten untuk Pembimbing 2 -->
                    <div id="content-pembimbing2" class="pembimbing-detail hidden">
                        <div class="row mb-3 align-items-center">
                            <div class="col-auto">
                                @if ($bimbingan->pembimbingta2->foto == '-')
                                    <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                        alt="Foto Mahasiswa" class="img-fluid rounded"
                                        style="max-width: 60px; height: 60px;">
                                @else
                                    <img src="{{ asset('storage/' . $bimbingan->pembimbingta2->foto) }}?{{ time() }}"
                                        alt="Foto Mahasiswa" class="img-fluid rounded"
                                        style="max-width: 60px; height: 60px;">
                                @endif
                            </div>
                            <div class="col-auto">
                                <h5 class="mb-0"><a href="#"
                                        class="text-decoration-none text-dark">{{ $bimbingan->pembimbingta2->namadosen }}</a>
                                </h5>
                                <span class="text-muted">Pembimbing Dua</span>
                            </div>
                        </div>

                        <!-- Divider -->
                        <hr class="sidebar-divider" style="border-color: #7e7e7e">

                        <div>
                            <a href="/admin/bimbingan/pembahasanp2" class="btn btn-primary my-3 col-auto btn-pembimbing2">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pembahasan</th>
                                    <th>Tanggal Bimbingan</th>
                                    <th>Validasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPembimbing2 as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ Str::limit($item->pembahasan, 50, '...') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if ($item->verifikasibimbingan == '0')
                                                <span class="badge bg-secondary p-2">Belum</span>
                                            @else
                                                <span class="badge bg-success p-2">Sudah</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary detail-btn" data-toggle="modal"
                                                data-target="#detailModal"
                                                data-tglbimbingan="{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}"
                                                data-pembahasan="{{ $item->pembahasan }}">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>

                                            <input type="hidden" class="edit-url"
                                                value="/admin/bimbingan/editpembahasanp2/{{ $item->id }}">

                                            {{-- <a href="/admin/bimbingan/editpembahasanp2/{{ $item->id }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a> --}}

                                            <form action="/admin/bimbingan/{{ $item->id }}" method="post"
                                                class="d-inline delete-form">
                                                @csrf
                                                @method('delete')
                                                <button type="button" class="btn btn-danger delete-btn"><i
                                                        class="fas fa-trash-alt"></i> Remove</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    @elseif (Gate::allows('isDosen'))
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card p-4 shadow-sm">
                    <div class="mb-4">
                        <a href="/admin/bimbingan" class="btn btn-outline-primary d-inline-block" style="width:auto;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="text-center">
                        <div class="mb-3">
                            @if ($bimbingan->mahasiswa->foto == '-')
                                <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                    alt="Foto Mahasiswa" class="img-fluid rounded"
                                    style="max-width: 150px; height: auto;">
                            @else
                                <img src="{{ asset('storage/' . $bimbingan->mahasiswa->foto) }}?{{ time() }}"
                                    alt="Foto Dosen" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                    </div>
                    <table class="table mb-4 table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">NIM</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->nim ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jurusan</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->jurusan->namajurusan ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Program Studi</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->prodi->namajenjang ?? 'Data tidak tersedia' }}
                                    {{ $bimbingan->mahasiswa->prodi->namaprodi ?? 'Data tidak tersedia' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th scope="row" colspan="2">Judul Tugas Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td><strong>{{ $bimbingan->pilihjudul ?? 'Data tidak tersedia' }}</strong></td>
                            </tr>
                        </tbody>
                    </table>

                    @if ($bimbinganCount >= 2)
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th scope="row" colspan="2">Verifikasi Sidang TA</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>
                                        @if ($cek)
                                            <a href="/sita/accsidangta/{{ $bimbingan->id }}"
                                                class="btn btn-success disabled">Sudah Verifikasi</a>
                                        @else
                                            <a href="/sita/accsidangta/{{ $bimbingan->id }}"
                                                class="btn btn-success">Verifikasi</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>

            <div class="col-lg-8">
                <div class="pembimbing-content card p-4 shadow-sm"
                    style="border-top: none; border-radius: 0 8px 8px 8px;">

                    <div id="content-pembimbing1" class="pembimbing-detail">
                        <div class="row mb-3 align-items-center">
                            @if ($bimbingan->pembimbingta1->id == $pembimbingId)
                                <div class="col-auto">
                                    @if ($bimbingan->pembimbingta1->foto == '-')
                                        <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @else
                                        <img src="{{ asset('storage/' . $bimbingan->pembimbingta1->foto) }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <h5 class="mb-0"><a href="#"
                                            class="text-decoration-none text-dark">{{ $bimbingan->pembimbingta1->namadosen }}</a>
                                    </h5>
                                    <span class="text-muted">Pembimbing Satu</span>
                                </div>
                            @elseif ($bimbingan->pembimbingta2->id == $pembimbingId)
                                <div class="col-auto">
                                    @if ($bimbingan->pembimbingta2->foto == '-')
                                        <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @else
                                        <img src="{{ asset('storage/' . $bimbingan->pembimbingta2->foto) }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <h5 class="mb-0"><a href="#"
                                            class="text-decoration-none text-dark">{{ $bimbingan->pembimbingta2->namadosen }}</a>
                                    </h5>
                                    <span class="text-muted">Pembimbing Dua</span>
                                </div>
                            @endif
                        </div>

                        <!-- Divider -->
                        <hr class="sidebar-divider" style="border-color: #7e7e7e">

                        {{-- <div>
                            <a href="/admin/bimbingan/pembahasanp1" class="btn btn-primary my-3 col-auto ">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div> --}}

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pembahasan</th>
                                    <th>Tanggal Bimbingan</th>
                                    <th>Validasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ Str::limit($item->pembahasan, 50, '...') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if ($item->verifikasibimbingan == '0')
                                                <span class="badge bg-secondary p-2">Belum</span>
                                            @else
                                                <span class="badge bg-success p-2">Sudah</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary detail-btn" href="#" data-toggle="modal"
                                                data-target="#detailModal" data-id="{{ $item->id }}"
                                                data-tglbimbingan="{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}"
                                                data-pembahasan="{{ $item->pembahasan }}">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>

                                            @if (Gate::allows('isMahasiswa'))
                                                <input type="hidden" class="edit-url"
                                                    value="/admin/bimbingan/editpembahasanp1/{{ $item->id }}">
                                            @endif

                                            {{-- <a href="/admin/bimbingan/editpembahasanp1/{{ $item->id }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a> --}}

                                            @if (Gate::allows('isMahasiswa'))
                                                <form action="/admin/bimbingan/{{ $item->id }}" method="post"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger delete-btn"><i
                                                            class="fas fa-trash-alt"></i> Remove</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    @elseif (Gate::allows('isKaprodi'))
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card p-4 shadow-sm">
                    <div class="mb-4">
                        <a href="/admin/bimbingan" class="btn btn-outline-primary d-inline-block" style="width:auto;">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="text-center">
                        <div class="mb-3">
                            @if ($bimbingan->mahasiswa->foto == '-')
                                <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                    alt="Foto Mahasiswa" class="img-fluid rounded"
                                    style="max-width: 150px; height: auto;">
                            @else
                                <img src="{{ asset('storage/' . $bimbingan->mahasiswa->foto) }}?{{ time() }}"
                                    alt="Foto Dosen" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                    </div>
                    <table class="table mb-4 table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">NIM</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->nim ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Jurusan</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->jurusan->namajurusan ?? 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Program Studi</th>
                                <th>:</th>
                                <td>{{ $bimbingan->mahasiswa->prodi->namajenjang ?? 'Data tidak tersedia' }}
                                    {{ $bimbingan->mahasiswa->prodi->namaprodi ?? 'Data tidak tersedia' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th scope="row" colspan="2">Judul Tugas Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td><strong>{{ $bimbingan->pilihjudul ?? 'Data tidak tersedia' }}</strong></td>
                            </tr>
                        </tbody>
                    </table>

                    @if ($bimbinganCount >= 2)
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th scope="row" colspan="2">Verifikasi Sidang TA</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>
                                        @if ($cek)
                                            <a href="/sita/accsidangta/{{ $bimbingan->id }}"
                                                class="btn btn-success disabled">Sudah Verifikasi</a>
                                        @else
                                            <a href="/sita/accsidangta/{{ $bimbingan->id }}"
                                                class="btn btn-success">Verifikasi</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif

                </div>
            </div>

            <div class="col-lg-8">
                <div class="pembimbing-content card p-4 shadow-sm"
                    style="border-top: none; border-radius: 0 8px 8px 8px;">

                    <div id="content-pembimbing1" class="pembimbing-detail">
                        <div class="row mb-3 align-items-center">
                            @if ($bimbingan->pembimbingta1->id == $pembimbingId)
                                <div class="col-auto">
                                    @if ($bimbingan->pembimbingta1->foto == '-')
                                        <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @else
                                        <img src="{{ asset('storage/' . $bimbingan->pembimbingta1->foto) }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <h5 class="mb-0"><a href="#"
                                            class="text-decoration-none text-dark">{{ $bimbingan->pembimbingta1->namadosen }}</a>
                                    </h5>
                                    <span class="text-muted">Pembimbing Satu</span>
                                </div>
                            @elseif ($bimbingan->pembimbingta2->id == $pembimbingId)
                                <div class="col-auto">
                                    @if ($bimbingan->pembimbingta2->foto == '-')
                                        <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @else
                                        <img src="{{ asset('storage/' . $bimbingan->pembimbingta2->foto) }}?{{ time() }}"
                                            alt="Foto Pembimbing" class="img-fluid rounded"
                                            style="max-width: 60px; height: 60px;">
                                    @endif
                                </div>
                                <div class="col-auto">
                                    <h5 class="mb-0"><a href="#"
                                            class="text-decoration-none text-dark">{{ $bimbingan->pembimbingta2->namadosen }}</a>
                                    </h5>
                                    <span class="text-muted">Pembimbing Dua</span>
                                </div>
                            @endif
                        </div>

                        <!-- Divider -->
                        <hr class="sidebar-divider" style="border-color: #7e7e7e">

                        {{-- <div>
                            <a href="/admin/bimbingan/pembahasanp1" class="btn btn-primary my-3 col-auto ">
                                <i class="fas fa-plus"></i> Tambah Data
                            </a>
                        </div> --}}

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pembahasan</th>
                                    <th>Tanggal Bimbingan</th>
                                    <th>Validasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ Str::limit($item->pembahasan, 50, '...') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}</td>
                                        <td class="text-center">
                                            @if ($item->verifikasibimbingan == '0')
                                                <span class="badge bg-secondary p-2">Belum</span>
                                            @else
                                                <span class="badge bg-success p-2">Sudah</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary detail-btn" href="#" data-toggle="modal"
                                                data-target="#detailModal" data-id="{{ $item->id }}"
                                                data-tglbimbingan="{{ \Carbon\Carbon::parse($item->tglbimbingan)->format('d-m-Y') }}"
                                                data-pembahasan="{{ $item->pembahasan }}">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>

                                            @if (Gate::allows('isMahasiswa'))
                                                <input type="hidden" class="edit-url"
                                                    value="/admin/bimbingan/editpembahasanp1/{{ $item->id }}">
                                            @endif

                                            {{-- <a href="/admin/bimbingan/editpembahasanp1/{{ $item->id }}"
                                            class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a> --}}

                                            @if (Gate::allows('isMahasiswa'))
                                                <form action="/admin/bimbingan/{{ $item->id }}" method="post"
                                                    class="d-inline delete-form">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="button" class="btn btn-danger delete-btn"><i
                                                            class="fas fa-trash-alt"></i> Remove</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Bimbingan</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tanggal Bimbingan:</strong> <span id="modalTglBimbingan"></span></p>
                    <p><strong>Pembahasan:<br></strong> <span id="modalPembahasan"></span></p>
                </div>
                <div class="modal-footer">
                    @if (Gate::allows('isKaprodi') || Gate::allows('isDosen'))
                        <div class="d-flex flex-column me-auto align-items-start">
                            <form id="validasiForm" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="verifikasibimbingan" value="1">
                                @if ($item->verifikasibimbingan == '0')
                                    <button type="submit" class="btn btn-success rounded-pill px-3 shadow-sm">
                                        Validasi?
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-success rounded-pill px-3 shadow-sm" disabled>
                                        <i class="fas fa-check me-2"></i> Sudah Validasi
                                    </button>
                                @endif
                            </form>
                        </div>
                    @endif
                    @if (Gate::allows('isMahasiswa'))
                        <a href="#" id="modalEditButton" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit</a>
                    @endif
                    <button type="button" class="btn btn-secondary ms-auto" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menangani klik pada Pembimbing 1
        document.getElementById('bimbinganpembimbing1').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah tautan default
            // Menghapus kelas active dari semua menu
            document.getElementById('bimbinganpembimbing1').classList.add('active');
            document.getElementById('bimbinganpembimbing2').classList.remove('active');

            // Menampilkan konten yang sesuai
            document.getElementById('content-pembimbing1').classList.remove('hidden');
            document.getElementById('content-pembimbing2').classList.add('hidden');
        });

        // Menangani klik pada Pembimbing 2
        document.getElementById('bimbinganpembimbing2').addEventListener('click', function(event) {
            event.preventDefault(); // Mencegah tautan default
            // Menghapus kelas active dari semua menu
            document.getElementById('bimbinganpembimbing2').classList.add('active');
            document.getElementById('bimbinganpembimbing1').classList.remove('active');

            // Menampilkan konten yang sesuai
            document.getElementById('content-pembimbing2').classList.remove('hidden');
            document.getElementById('content-pembimbing1').classList.add('hidden');
        });

        // Set Pembimbing 1 sebagai aktif secara default saat halaman dimuat
        document.getElementById('bimbinganpembimbing1').classList.add('active');
        document.getElementById('content-pembimbing1').classList.remove('hidden');
        document.getElementById('content-pembimbing2').classList.add('hidden');
    </script>

    <script>
        document.querySelectorAll('.detail-btn').forEach(button => {
            button.addEventListener('click', function() {
                const tglBimbingan = this.getAttribute('data-tglbimbingan');
                const pembahasan = this.getAttribute('data-pembahasan');
                @if (Gate::allows('isMahasiswa'))
                    const editUrl = this.closest('tr').querySelector('.edit-url').value;
                @endif

                document.getElementById('modalTglBimbingan').innerText = tglBimbingan;
                document.getElementById('modalPembahasan').innerText = pembahasan;

                @if (Gate::allows('isMahasiswa'))
                    document.getElementById('modalEditButton').setAttribute('href', editUrl);
                @endif

                const modal = new bootstrap.Modal(document.getElementById('detailModal'));
                modal.show();
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const detailBtns = document.querySelectorAll('.detail-btn');
            const modalTglBimbingan = document.getElementById('modalTglBimbingan');
            const modalPembahasan = document.getElementById('modalPembahasan');
            const validasiForm = document.getElementById('validasiForm');

            detailBtns.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const id = btn.getAttribute('data-id');
                    const tglBimbingan = btn.getAttribute('data-tglbimbingan');
                    const pembahasan = btn.getAttribute('data-pembahasan');

                    // Update modal content
                    modalTglBimbingan.textContent = tglBimbingan;
                    modalPembahasan.textContent = pembahasan;

                    // Update form action URL
                    validasiForm.action = `/bimbingan/${id}/validasi`;
                });
            });
        });
    </script>
@endsection
