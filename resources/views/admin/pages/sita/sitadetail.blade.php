@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2 class="my-3">Data Pengajuan Sidang TA</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th colspan="3">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Judul Proposal</td>
                        <td colspan="2">{{ $sita->sitatugasakhir->pilihjudul }}</td>
                    </tr>
                    <tr>
                        <td>Nama Mahasiswa</td>
                        <td colspan="2">{{ $sita->sitatugasakhir->mahasiswa->namamhs }}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td colspan="2">{{ $sita->sitatugasakhir->mahasiswa->nim }}</td>
                    </tr>
                    <tr>
                        <td>Pembimbing Satu</td>
                        <td colspan="2">{{ $sita->sitatugasakhir->pembimbingta1->namadosen }} - Sudah
                            Validasi</td>
                    </tr>
                    <tr>
                        <td>Pembimbing Dua</td>
                        <td colspan="2">{{ $sita->sitatugasakhir->pembimbingta2->namadosen }} - Sudah
                            Validasi</td>
                    </tr>
                    @if ($sita->ketuasidang_id != 0)
                        <tr>
                            <td>Ketua Sidang</td>
                            <td colspan="2">{{ $sita->ketuasita->namadosen }}</td>
                        </tr>
                        <tr>
                            <td>Sekretaris Sidang</td>
                            <td colspan="2">{{ $sita->sekretarissita->namadosen }}</td>
                        </tr>
                        <tr>
                            <td>Penguji Satu</td>
                            <td colspan="2">{{ $sita->penguji1sita->namadosen }}</td>
                        </tr>
                        <tr>
                            <td>Penguji Dua</td>
                            <td colspan="2">{{ $sita->penguji2sita->namadosen }}</td>
                        </tr>
                    @endif

                    @if ($sita->tgl_sita != null)
                        <tr>
                            <td>Tanggal Sidang</td>
                            <td colspan="2">
                                {{ \Carbon\Carbon::parse($sita->tgl_sita)->locale('id')->translatedFormat('l, d F Y') }}
                                - {{ $sita->sesisidang->namasesi }}:
                                {{ \Carbon\Carbon::parse($sita->sesisidang->waktumulai)->translatedFormat('H:i') }}-{{ \Carbon\Carbon::parse($sita->sesisidang->waktuakhir)->translatedFormat('H:i') }}
                            </td>
                        </tr>
                    @endif
                    @if ($sita->ruangan_id != 0)
                        <tr>
                            <td>Ruangan Sidang</td>
                            <td colspan="2">
                                {{ $sita->ruangansita->koderuangan }} - {{ $sita->ruangansita->namaruangan }}

                            </td>
                        </tr>
                    @endif

                    @if ($sita->status == 2)
                        <tr>
                            <td>Status Validasi Dokumen</td>
                            <td colspan="2">
                                Sudah Divalidasi
                            </td>
                        </tr>
                    @endif

                    <tr>
                        <td>Dokumen Proposal</td>
                        <td colspan="2"><a href="/fulltadownload/{{ $sita->tugasakhir_id }}">Unduh Dokumen</a></td>
                    </tr>
                    @if ($sita->status == 6 || $sita->status == 7)
                        <tr>
                            <td>Nilai Sidang TA</td>
                            <td colspan="2">{{ $sita->nilaiakhir }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td>Status</td>
                        @if ($sita->status == 1)
                            <td>Sedang Diajukan</td>
                        @elseif($sita->status == 2)
                            <td>Sudah Divalidasi</td>
                        @elseif($sita->status == 3)
                            <td>Dijadwalkan</td>
                        @elseif($sita->status == 4)
                            <td>Sedang Sidang</td>
                        @elseif($sita->status == 5)
                            <td>Sedang Dinilai</td>
                        @elseif($sita->status == 6)
                            <td>Lulus</td>
                        @elseif($sita->status == 7)
                            <td>Tidak Lulus</td>
                        @endif
                    </tr>

                </tbody>
            </table>
            @if ($sita->status == 2)
                @can('isKaprodi')
                    <a href="/sitajadwal/{{ $sita->id }}" class="btn btn-primary float-end mx-1">Jadwalkan</a>
                @endcan
            @else
                @can('isKaprodi')
                    @if ($edit === 1)
                        <a href="/editsitajadwal/{{ $sita->id }}" class="btn btn-primary float-end mx-1">Ubah
                            Penjadwalan</a>
                    @endif
                @endcannot

                @can('isAdmin')
                    @if ($sita->status == 1)
                        <a href="/validasidokumen/{{ $sita->id }}" class="btn btn-primary float-end mx-1">Validasi</a>
                        <a href="/tolakvalidasidokumen/{{ $sita->id }}" class="btn btn-primary float-end mx-1">Tolak</a>
                    @endif
                @endcan
            @endif

            @cannot('isAdmin')
                @if (
                    $sita->sitatugasakhir->pembimbingta1->id == $dosenId ||
                        $sita->sitatugasakhir->pembimbingta2->id == $dosenId ||
                        $sita->penguji1_id == $dosenId ||
                        $sita->penguji2_id == $dosenId)
                    @if ($sita->status == 6 || $sita->status == 7)
                        <a href="/nilaisita/{{ $sita->id }}" class="btn btn-primary float-end mx-1">Lihat Nilai</a>
                    @elseif(in_array($sita->status, [3, 4, 5]))
                        <a href="/nilaisita/{{ $sita->id }}" class="btn btn-primary float-end mx-1">Nilai</a>
                    @endif
                @endif
            @endcannot

            <a href="/sita" class="btn btn-primary float-end mx-1">Kembali</a>

        </div>
    </div>
@endsection
