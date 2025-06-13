@extends('admin.layouts.template')
{{-- <style>
    table tbody th {
        width: 500px;
    }
</style> --}}
@section('main')
    <div class="card m-1 p-4">
        <div class="mb-4">
            <a href="/admin/sempro" class="btn btn-outline-primary col-1 d-inline-block" style="width:auto;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <h2 class="my-3">Data Seminar Proposal</h2>
        @if (Gate::allows('isKaprodi'))
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                        @if ($dataSempro->status_sempro == '2')
                            <th scope="row">Detail</th>
                            <td><a href="/sempro/penjadwalan/{{ $dataSempro->id }}/edit">Ubah Penjadwalan</a></td>
                        @else
                            <th scope="row" colspan="2">Detail</th>
                        @endif
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td>{{ $dataSempro->tugasakhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Judul Proposal</th>
                        <td>{{ $dataSempro->tugasakhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Dokumen Proposal</th>
                        <td>
                            <a href="{{ Storage::url($dataSempro->file_sempro) }}" class="btn btn-primary"
                                {{-- target="_blank" --}}>Download Dokumen</a>
                        </td>
                    </tr>

                    @if ($dataSempro->pengujisempro_id != $pembimbingId)
                        @foreach ($validasiSempro1 as $item)
                            <tr>
                                <th scope="row">Verifikasi Pembimbing 1</th>
                                <td>
                                    @if ($item->pembimbing1_acc == '0')
                                        <div class="d-flex flex-column me-auto align-items-start">
                                            <form action="/sempro/{{ $item->id }}/validasisemp1" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="pembimbing1_acc" value="1">
                                                <button type="submit" class="btn btn-info rounded-pill px-3 shadow-sm">
                                                    Validasi Seminar Proposal Mahasiswa?
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($item->pembimbing1_acc == '1')
                                        <button type="submit" class="btn btn-success rounded-pill px-3 shadow-sm" disabled>
                                            <i class="fa-solid fa-check"></i> Sudah Validasi
                                        </button>
                                    @else
                                        {{ $item->pembimbing1_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Verifikasi Pembimbing 2</th>
                                <td>
                                    @if ($dataSempro->pembimbing2_acc == '0')
                                        {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Belum
                                            diverifikasi</span>
                                    @elseif ($dataSempro->pembimbing2_acc == '1')
                                        {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Sudah
                                            diverifikasi</span>
                                    @else
                                        {{ $dataSempro->pembimbing2_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($validasiSempro2 as $item)
                            <tr>
                                <th scope="row">Verifikasi Pembimbing 1</th>
                                <td>
                                    @if ($dataSempro->pembimbing1_acc == '0')
                                        {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Belum
                                            diverifikasi</span>
                                    @elseif ($dataSempro->pembimbing1_acc == '1')
                                        {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Sudah
                                            diverifikasi</span>
                                    @else
                                        {{ $dataSempro->pembimbing1_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Verifikasi Pembimbing 2</th>
                                <td>
                                    @if ($item->pembimbing2_acc == '0')
                                        <div class="d-flex flex-column me-auto align-items-start">
                                            <form action="/sempro/{{ $item->id }}/validasisemp2" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="pembimbing2_acc" value="1">
                                                {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} -
                                                <button type="submit" class="btn btn-info rounded-pill px-3 shadow-sm">
                                                    Validasi Seminar Proposal Mahasiswa?
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($item->pembimbing2_acc == '1')
                                        {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} -
                                        <button type="submit" class="btn btn-success rounded-pill px-3 shadow-sm" disabled>
                                            <i class="fa-solid fa-check"></i> Sudah Validasi
                                        </button>
                                    @else
                                        {{ $item->pembimbing2_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th scope="row">Verifikasi Pembimbing 1</th>
                            <td>
                                @if ($dataSempro->pembimbing1_acc == '0')
                                    {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Belum
                                        diverifikasi</span>
                                @elseif ($dataSempro->pembimbing1_acc == '1')
                                    {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Sudah
                                        diverifikasi</span>
                                @else
                                    {{ $dataSempro->pembimbing1_acc ?? 'Data tidak tersedia' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Verifikasi Pembimbing 2</th>
                            <td>
                                @if ($dataSempro->pembimbing2_acc == '0')
                                    {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Belum
                                        diverifikasi</span>
                                @elseif ($dataSempro->pembimbing2_acc == '1')
                                    {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Sudah
                                        diverifikasi</span>
                                @else
                                    {{ $dataSempro->pembimbing2_acc ?? 'Data tidak tersedia' }}
                                @endif
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <th scope="row">Dosen Penguji</th>
                        <td>
                            @if ($dataSempro->pengujisempro_id)
                                <a href="/admin/tugasakhir/detaildosen/{{ $dataSempro->pengujisempro_id }}">
                                    {{ $dataSempro->pengujisempro->namadosen }}
                                @else
                                    <span>Belum Ditetapkan</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Jadwal Seminar Proposal</th>
                        <td>
                            @if ($dataSempro->tgl_sempro)
                                {{ \Carbon\Carbon::parse($dataSempro->tgl_sempro)->locale('id')->translatedFormat('l, d F Y') }}
                                - {{ $dataSempro->sesisidang->namasesi }}:
                                {{ \Carbon\Carbon::parse($dataSempro->sesisidang->waktumulai)->translatedFormat('H:i') }}-{{ \Carbon\Carbon::parse($dataSempro->sesisidang->waktuakhir)->translatedFormat('H:i') }}
                            @else
                                Belum Ditetapkan
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Ruangan Seminar Proposal</th>
                        <td>
                            @if ($dataSempro->ruangan_id)
                                {{ $dataSempro->ruangansempro->koderuangan }}-{{ $dataSempro->ruangansempro->namaruangan }}
                            @else
                                Belum Ditetapkan
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Nilai Sempro</th>
                        <td>
                            @if ($dataSempro->nilaiakhir)
                                {{ $dataSempro->nilaiakhir }}
                            @else
                                Belum Ditetapkan
                            @endif
                        </td>
                    </tr>


                    <tr>
                        <th scope="row">Status Usulan</th>
                        <td>
                            @if ($dataSempro->status_sempro == '0')
                                <span>Pengajuan</span>
                            @elseif ($dataSempro->status_sempro == '1')
                                <span>Seminar Proposal Divalidasi</span>
                            @elseif ($dataSempro->status_sempro == '2')
                                <span>Sudah Dijadwalkan</span>
                            @elseif ($dataSempro->status_sempro == '3')
                                <span>Sudah Dinilai</span>
                            @elseif ($dataSempro->status_sempro == '4')
                                <span>Lulus</span>
                            @elseif ($dataSempro->status_sempro == '5')
                                <span>Tidak Lulus</span>
                            @else
                                <span>Data tidak tersedia</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @if ($dataSempro->status_sempro == '1')
                @if ($dataSempro->pembimbing1_acc == '1' && $dataSempro->pembimbing2_acc == '1')
                    <div class="mt-3 text-end">
                        <a href="/sempro/penjadwalan/{{ $dataSempro->id }}" class="btn btn-primary">Jadwalkan Seminar
                            Proposal</a>
                    </div>
                @endif
            @elseif ($dataSempro->status_sempro != '0' && $dataSempro->status_sempro != '1')
                <div class="mt-3 text-end">
                    <a href="/sempro/penilaian/{{ $dataSempro->id }}" class="btn btn-primary">Nilai</a>
                </div>
            @endif
        @elseif (Gate::allows('isDosen'))
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                        <th scope="row" colspan="2">Detail</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th scope="row">Nama</th>
                        <td>{{ $dataSempro->tugasakhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Judul Proposal</th>
                        <td>{{ $dataSempro->tugasakhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                    </tr>

                    <tr>
                        <th scope="row">Dokumen Proposal</th>
                        <td>
                            <a href="{{ Storage::url($dataSempro->file_sempro) }}" class="btn btn-primary"
                                {{-- target="_blank" --}}>Download Dokumen</a>
                        </td>
                    </tr>

                    @if ($dataSempro->pengujisempro_id != $pembimbingId)
                        @foreach ($validasiSempro1 as $item)
                            <tr>
                                <th scope="row">Verifikasi Pembimbing 1</th>
                                <td>
                                    @if ($item->pembimbing1_acc == '0')
                                        <div class="d-flex flex-column me-auto align-items-start">
                                            <form action="/sempro/{{ $item->id }}/validasisemp1" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="pembimbing1_acc" value="1">
                                                {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} -
                                                <button type="submit" class="btn btn-info rounded-pill px-3 shadow-sm">
                                                    Validasi Seminar Proposal Mahasiswa?
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($item->pembimbing1_acc == '1')
                                        {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} -
                                        <button type="submit" class="btn btn-success rounded-pill px-3 shadow-sm" disabled>
                                            <i class="fa-solid fa-check"></i> Sudah Validasi
                                        </button>
                                    @else
                                        {{ $item->pembimbing1_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Verifikasi Pembimbing 2</th>
                                <td>
                                    @if ($dataSempro->pembimbing2_acc == '0')
                                        {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Belum
                                            diverifikasi</span>
                                    @elseif ($dataSempro->pembimbing2_acc == '1')
                                        {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Sudah
                                            diverifikasi</span>
                                    @else
                                        {{ $dataSempro->pembimbing2_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        @foreach ($validasiSempro2 as $item)
                            <tr>
                                <th scope="row">Verifikasi Pembimbing 1</th>
                                <td>
                                    @if ($dataSempro->pembimbing1_acc == '0')
                                        {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Belum
                                            diverifikasi</span>
                                    @elseif ($dataSempro->pembimbing1_acc == '1')
                                        {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Sudah
                                            diverifikasi</span>
                                    @else
                                        {{ $dataSempro->pembimbing1_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Verifikasi Pembimbing 2</th>
                                <td>
                                    @if ($item->pembimbing2_acc == '0')
                                        <div class="d-flex flex-column me-auto align-items-start">
                                            <form action="/sempro/{{ $item->id }}/validasisemp2" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="pembimbing2_acc" value="1">
                                                {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} -
                                                <button type="submit" class="btn btn-info rounded-pill px-3 shadow-sm">
                                                    Validasi Seminar Proposal Mahasiswa?
                                                </button>
                                            </form>
                                        </div>
                                    @elseif ($item->pembimbing2_acc == '1')
                                        {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} -
                                        <button type="submit" class="btn btn-success rounded-pill px-3 shadow-sm" disabled>
                                            <i class="fa-solid fa-check"></i> Sudah Validasi
                                        </button>
                                    @else
                                        {{ $item->pembimbing2_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @elseif ($dataSempro->pengujisempro_id == $pembimbingId)
                        <tr>
                            <th scope="row">Verifikasi Pembimbing 1</th>
                            <td>
                                @if ($dataSempro->pembimbing1_acc == '0')
                                    {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Belum
                                        diverifikasi</span>
                                @elseif ($dataSempro->pembimbing1_acc == '1')
                                    {{ $dataSempro->tugasakhir->pembimbingta1->namadosen }} - <span>Sudah
                                        diverifikasi</span>
                                @else
                                    {{ $dataSempro->pembimbing1_acc ?? 'Data tidak tersedia' }}
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">Verifikasi Pembimbing 2</th>
                            <td>
                                @if ($dataSempro->pembimbing2_acc == '0')
                                    {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Belum
                                        diverifikasi</span>
                                @elseif ($dataSempro->pembimbing2_acc == '1')
                                    {{ $dataSempro->tugasakhir->pembimbingta2->namadosen }} - <span>Sudah
                                        diverifikasi</span>
                                @else
                                    {{ $dataSempro->pembimbing2_acc ?? 'Data tidak tersedia' }}
                                @endif
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <th scope="row">Dosen Penguji</th>
                        <td>
                            @if ($dataSempro->pengujisempro_id)
                                <a href="/admin/tugasakhir/detaildosen/{{ $dataSempro->pengujisempro_id }}">
                                    {{ $dataSempro->pengujisempro->namadosen }}
                                @else
                                    <span>Belum Ditetapkan</span>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Jadwal Seminar Proposal</th>
                        <td>
                            @if ($dataSempro->tgl_sempro)
                                {{ \Carbon\Carbon::parse($dataSempro->tgl_sempro)->locale('id')->translatedFormat('l, d F Y') }}
                                - {{ $dataSempro->sesisidang->namasesi }}:
                                {{ \Carbon\Carbon::parse($dataSempro->sesisidang->waktumulai)->translatedFormat('H:i') }}-{{ \Carbon\Carbon::parse($dataSempro->sesisidang->waktuakhir)->translatedFormat('H:i') }}
                            @else
                                Belum Ditetapkan
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Ruangan Seminar Proposal</th>
                        <td>
                            @if ($dataSempro->ruangan_id)
                                {{ $dataSempro->ruangansempro->koderuangan }}-{{ $dataSempro->ruangansempro->namaruangan }}
                            @else
                                Belum Ditetapkan
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Nilai Sempro</th>
                        <td>
                            @if ($dataSempro->nilaiakhir)
                                {{ $dataSempro->nilaiakhir }}
                            @else
                                Belum Ditetapkan
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th scope="row">Status Usulan</th>
                        <td>
                            @if ($dataSempro->status_sempro == '0')
                                <span>Pengajuan</span>
                            @elseif ($dataSempro->status_sempro == '1')
                                <span>Seminar Proposal Divalidasi</span>
                            @elseif ($dataSempro->status_sempro == '2')
                                <span>Sudah Dijadwalkan</span>
                            @elseif ($dataSempro->status_sempro == '3')
                                <span>Sudah Dinilai</span>
                            @elseif ($dataSempro->status_sempro == '4')
                                <span>Lulus</span>
                            @elseif ($dataSempro->status_sempro == '5')
                                <span>Tidak Lulus</span>
                            @else
                                <span>Data tidak tersedia</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            @if ($dataSempro->status_sempro != '0' && $dataSempro->status_sempro != '1')
                <div class="mt-3 text-end">
                    <a href="/sempro/penilaian/{{ $dataSempro->id }}" class="btn btn-primary">Nilai</a>
                </div>
            @endif
        @endif
    </div>
@endsection
