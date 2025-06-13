@extends('admin.layouts.template')

@section('main')
    <div class="card m-3 p-4 shadow-sm">
        @if (Auth::user()->can('isMahasiswa'))
            <div class="mb-4">
                <a href="/admin/tugasakhir" class="btn btn-outline-primary col-1 d-inline-block" style="width:auto;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            @if ($tugasAkhir->status_usulan == '0')
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" style="width: 200px;">Detail</th>
                            <td><a href="/admin/tugasakhir/{{ $tugasAkhir->id }}/edit">Ubah Pengajuan Proposal</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 200px;">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul 1</th>
                            <td>{{ $tugasAkhir->judul1 ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal 1</th>
                            <td>
                                @if ($tugasAkhir->dokumen_proposal1)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Judul 2</th>
                            <td>{{ $tugasAkhir->judul2 ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal 2</th>
                            <td>
                                @if ($tugasAkhir->dokumen_proposal2)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Catatan</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($tugasAkhir->status_usulan == '1')
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" colspan="2" style="width: 200px;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul</th>
                            <td>{{ $tugasAkhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Pembimbing 1</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing1 }}">
                                    {{ $tugasAkhir->pembimbingta1->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pembimbing 2</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing2 }}">
                                    {{ $tugasAkhir->pembimbingta2->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal</th>
                            <td>
                                @if ($tugasAkhir->pilihjudul == $tugasAkhir->judul1)
                                    @if ($tugasAkhir->dokumen_proposal1)
                                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}"
                                            class="btn btn-primary" {{-- target="_blank" --}}>Download Dokumen</a>
                                    @else
                                        <span>Tidak ada dokumen</span>
                                    @endif
                                @elseif ($tugasAkhir->pilihjudul == $tugasAkhir->judul2)
                                    @if ($tugasAkhir->dokumen_proposal2)
                                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}"
                                            class="btn btn-primary" {{-- target="_blank" --}}>Download Dokumen</a>
                                    @else
                                        <span>Tidak ada dokumen</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Catatan</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Komentar</th>
                            <td>{{ $tugasAkhir->reviewta ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($tugasAkhir->status_usulan == '2')
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" style="width: 250px;">Detail</th>
                            <td><a href="/admin/tugasakhir/{{ $tugasAkhir->id }}/edit">Ubah Pengajuan Proposal</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul</th>
                            <td>{{ $tugasAkhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Pembimbing 1</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing1 }}">
                                    {{ $tugasAkhir->pembimbingta1->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pembimbing 2</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing2 }}">
                                    {{ $tugasAkhir->pembimbingta2->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal</th>
                            <td>
                                @if ($tugasAkhir->pilihjudul == $tugasAkhir->judul1)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @elseif ($tugasAkhir->pilihjudul == $tugasAkhir->judul2)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Catatan</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Komentar</th>
                            <td>{{ $tugasAkhir->reviewta ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($tugasAkhir->status_usulan == '3')
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" style="width: 250px;">Detail</th>
                            <td><a href="/admin/tugasakhir/{{ $tugasAkhir->id }}/edit">Ubah Pengajuan Proposal</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul</th>
                            <td>{{ $tugasAkhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Pembimbing 1</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing1 }}">
                                    {{ $tugasAkhir->pembimbingta1->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pembimbing 2</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing2 }}">
                                    {{ $tugasAkhir->pembimbingta2->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal</th>
                            <td>
                                @if ($tugasAkhir->pilihjudul == $tugasAkhir->judul1)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @elseif ($tugasAkhir->pilihjudul == $tugasAkhir->judul2)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Catatan dari Mahasiswa</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Komentar</th>
                            <td>{{ $tugasAkhir->reviewta ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($tugasAkhir->status_usulan == '4')
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" style="width: 250px;">Detail</th>
                            <td><a href="/admin/tugasakhir/{{ $tugasAkhir->id }}/edit">Ubah Pengajuan Proposal</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul</th>
                            <td>{{ $tugasAkhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Pembimbing 1</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing1 }}">
                                    {{ $tugasAkhir->pembimbingta1->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pembimbing 2</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing2 }}">
                                    {{ $tugasAkhir->pembimbingta2->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal</th>
                            <td>
                                @if ($tugasAkhir->pilihjudul == $tugasAkhir->judul1)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @elseif ($tugasAkhir->pilihjudul == $tugasAkhir->judul2)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Catatan dari Mahasiswa</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Komentar</th>
                            <td>{{ $tugasAkhir->reviewta ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @elseif ($tugasAkhir->status_usulan == '5')
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" colspan="2" style="width: 200px;">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row" style="width: 200px;">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul 1</th>
                            <td>{{ $tugasAkhir->judul1 ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal 1</th>
                            <td>
                                @if ($tugasAkhir->dokumen_proposal1)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Judul 2</th>
                            <td>{{ $tugasAkhir->judul2 ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal 2</th>
                            <td>
                                @if ($tugasAkhir->dokumen_proposal2)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Catatan</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @elseif (Auth::user()->can('isKaprodi'))
            <div class="mb-4">
                <a href="/admin/tugasakhir" class="btn btn-outline-primary col-1 d-inline-block" style="width:auto;">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            @if ($tugasAkhir->status_usulan == '0' || $tugasAkhir->status_usulan == '5')
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" style="width: 200px;">Detail</th>
                            <td><a href="/admin/tugasakhir/review/{{ $tugasAkhir->id }}">Review Proposal</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul 1</th>
                            <td>{{ $tugasAkhir->judul1 ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal 1</th>
                            <td>
                                @if ($tugasAkhir->dokumen_proposal1)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Judul 2</th>
                            <td>{{ $tugasAkhir->judul2 ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal 2</th>
                            <td>
                                @if ($tugasAkhir->dokumen_proposal2)
                                    <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                                        {{-- target="_blank" --}}>Download Dokumen</a>
                                @else
                                    <span>Tidak ada dokumen</span>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Catatan</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="row" style="width: 200px;">Detail</th>
                            <td><a href="/admin/tugasakhir/review/{{ $tugasAkhir->id }}">Review Proposal</a></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Nama</th>
                            <td>{{ $tugasAkhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Judul</th>
                            <td>{{ $tugasAkhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                        </tr>

                        <tr>
                            <th scope="row">Pembimbing 1</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing1 }}">
                                    {{ $tugasAkhir->pembimbingta1->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pembimbing 2</th>
                            <td>
                                <a href="/admin/tugasakhir/detaildosen/{{ $tugasAkhir->pembimbing2 }}">
                                    {{ $tugasAkhir->pembimbingta2->namadosen ?? 'Data tidak tersedia' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Dokumen Proposal</th>
                            <td>
                                @if ($tugasAkhir->pilihjudul == $tugasAkhir->judul1)
                                    @if ($tugasAkhir->dokumen_proposal1)
                                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}"
                                            class="btn btn-primary" {{-- target="_blank" --}}>Download Dokumen</a>
                                    @else
                                        <span>Tidak ada dokumen</span>
                                    @endif
                                @elseif ($tugasAkhir->pilihjudul == $tugasAkhir->judul2)
                                    @if ($tugasAkhir->dokumen_proposal2)
                                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}"
                                            class="btn btn-primary" {{-- target="_blank" --}}>Download Dokumen</a>
                                    @else
                                        <span>Tidak ada dokumen</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Catatan dari Mahasiswa</th>
                            <td>{{ $tugasAkhir->cttmhs ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Komentar</th>
                            <td>{{ $tugasAkhir->reviewta ?? 'Data tidak tersedia' }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Status Usulan</th>
                            <td>
                                @if ($tugasAkhir->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($tugasAkhir->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($tugasAkhir->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($tugasAkhir->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($tugasAkhir->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($tugasAkhir->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @else
                                    <span>Data tidak tersedia</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endif
        @endif
    </div>
@endsection
