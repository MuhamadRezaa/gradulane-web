@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        @if (Gate::allows('isMahasiswa'))
            @if ($dataSempro->count() <= 0)
                <h2 class="mb-3">Ajukan Seminar Proposal</h2>
                <div class="">
                    <h5>Belum ada pengajuan seminar proposal. Untuk melanjutkan, silakan ajukan <strong><a
                                href="/admin/sempro/create" class="mt-3" style="width:auto">di sini</a></strong>.</h5>
                </div>
            @else
                @foreach ($dataSempro as $item)
                    <h2 class="mb-3">Pengajuan Seminar Proposal</h2>
                    <table class="table table-striped table-bordered">
                        <thead class="text-center">
                            <tr>
                                @if ($item->pembimbing1_acc == '0' && $item->pembimbing2_acc == '0')
                                    <th scope="row" style="width: 500px;">Detail</th>
                                    <td><a href="/admin/sempro/{{ $item->id }}/edit" class="link">Ubah Pengajuan
                                            Proposal</a>
                                    </td>
                                @else
                                    <th scope="row" colspan="2" class="text-center bg-primary text-white"
                                        style="width: 500px;">Detail</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Nama</th>
                                <td>{{ $item->tugasakhir->mahasiswa->namamhs ?? 'Data tidak tersedia' }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Judul Proposal</th>
                                <td>{{ $item->tugasakhir->pilihjudul ?? 'Data tidak tersedia' }}</td>
                            </tr>

                            <tr>
                                <th scope="row">Verifikasi Pembimbing 1</th>
                                <td>
                                    @if ($item->pembimbing1_acc == '0')
                                        {{ $item->tugasakhir->pembimbingta1->namadosen }} - <span>Belum diverifikasi</span>
                                    @elseif ($item->pembimbing1_acc == '1')
                                        {{ $item->tugasakhir->pembimbingta1->namadosen }} - <span>Sudah diverifikasi</span>
                                    @else
                                        {{ $item->pembimbing1_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Verifikasi Pembimbing 2</th>
                                <td>
                                    @if ($item->pembimbing2_acc == '0')
                                        {{ $item->tugasakhir->pembimbingta2->namadosen }} - <span>Belum diverifikasi</span>
                                    @elseif ($item->pembimbing2_acc == '1')
                                        {{ $item->tugasakhir->pembimbingta2->namadosen }} - <span>Sudah diverifikasi</span>
                                    @else
                                        {{ $item->pembimbing2_acc ?? 'Data tidak tersedia' }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Dosen Penguji</th>
                                <td>
                                    @if ($item->pengujisempro_id != null)
                                        <a href="/admin/tugasakhir/detaildosen/{{ $item->pengujisempro_id }}">
                                            {{ $item->pengujisempro->namadosen }}
                                        @else
                                            <span>Belum Ditetapkan</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Jadwal Seminar Proposal</th>
                                <td>
                                    @if ($item->tgl_sempro)
                                        {{ \Carbon\Carbon::parse($item->tgl_sempro)->locale('id')->translatedFormat('l, d F Y') }}
                                        - {{ $item->sesisidang->namasesi }}:
                                        {{ \Carbon\Carbon::parse($item->sesisidang->waktumulai)->translatedFormat('H:i') }}-{{ \Carbon\Carbon::parse($item->sesisidang->waktuakhir)->translatedFormat('H:i') }}
                                    @else
                                        <span>Belum Ditetapkan</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">Ruangan Seminar Proposal</th>
                                <td>
                                    @if ($item->ruangan_id)
                                        {{ $item->ruangansempro->koderuangan }}-{{ $item->ruangansempro->namaruangan }}
                                    @else
                                        <span>Belum Ditetapkan</span>
                                    @endif
                                </td>
                            </tr>


                            @if ($item->status_sempro == 4 || $item->status_sempro == 5)
                                <tr>
                                    <td>Nilai Sidang Proposal</td>
                                    <td colspan="2">{{ $item->nilaiakhir }}</td>
                                </tr>
                            @endif

                            <tr>
                                <th scope="row">Status Usulan</th>
                                <td>
                                    @if ($item->status_sempro == '0')
                                        <span>Pengajuan</span>
                                    @elseif ($item->status_sempro == '1')
                                        <span>Seminar Proposal Divalidasi</span>
                                    @elseif ($item->status_sempro == '2')
                                        <span>Sudah Dijadwalkan</span>
                                    @elseif ($item->status_sempro == '3')
                                        <span>Sudah Dinilai</span>
                                    @elseif ($item->status_sempro == '4')
                                        <span>Lulus</span>
                                    @elseif ($item->status_sempro == '5')
                                        <span>Tidak Lulus</span>
                                    @else
                                        <span>Data tidak tersedia</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @if ($item->pembimbing1_acc == '0' && $item->pembimbing2_acc == '0')
                        <div class="mb-3 text-end">
                            <form action="/admin/sempro/{{ $item->id }}" method="post" class="d-inline delete-form">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger delete-btn">Batalkan
                                    Pengajuan</button>
                            </form>
                        </div>
                    @endif

                    @if ($item->status_sempro == 4 || $item->status_sempro == 5)
                        <h2 class="my-3">Detail Penilaian</h2>
                        {{-- <h5 class="my-3">Detail Penilaian</h5> --}}
                        <div class="table-responsive my-3">
                            <table class="table table-striped table-bordered">
                                <thead class="bg-primary text-white">
                                    <tr class="text-center">
                                        <th class="align-middle text-center text-white bg-primary">No</th>
                                        <th class="align-middle text-center text-white bg-primary">Aspek Penilaian
                                        </th>
                                        <th class="align-middle text-center text-white bg-primary">Deskripsi</th>
                                        <th class="align-middle text-center text-white bg-primary" style="width: 10%;">
                                            Pembimbing Satu</th>
                                        <th class="align-middle text-center text-white bg-primary" style="width: 10%;">
                                            Pembimbing Dua</th>
                                        <th class="align-middle text-center text-white bg-primary" style="width: 10%;">
                                            Penguji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Pendahuluan -->
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>Pendahuluan</td>
                                        <td>
                                            Mahasiswa mampu menjelaskan latar belakang, tujuan, dan kontribusi
                                            penelitian.
                                        </td>
                                        <td class="text-center">
                                            {{ $pembimbing1->nl_pendahuluan ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">
                                            {{ $pembimbing2->nl_pendahuluan ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">{{ $penguji->nl_pendahuluan ?? 'Belum Dinilai' }}
                                        </td>
                                    </tr>
                                    <!-- Tinjauan Pustaka -->
                                    <tr>
                                        <td class="text-center">2</td>
                                        <td>Tinjauan Pustaka</td>
                                        <td>Mahasiswa mampu menampilkan teori yang relevan dan dituliskan secara
                                            runtun dan
                                            lengkap dengan disertai argumentasi ilmiah dari pengusul proposal.</td>
                                        <td class="text-center">
                                            {{ $pembimbing1->nl_tinjauanpustaka ?? 'Belum Dinilai' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $pembimbing2->nl_tinjauanpustaka ?? 'Belum Dinilai' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $penguji->nl_tinjauanpustaka ?? 'Belum Dinilai' }}</td>
                                    </tr>
                                    <!-- Metodologi Penelitian -->
                                    <tr>
                                        <td class="text-center">3</td>
                                        <td>Metodologi Penelitian</td>
                                        <td>Mahasiswa mampu menentukan metode yang selaras dengan permasalahan dan
                                            konsep
                                            teori. Detail rancangan penelitian diuraikan dengan runtun setiap
                                            tahapan dan
                                            dapat diselesaikan sesuai dengan rencana waktu penelitian.</td>
                                        <td class="text-center">
                                            {{ $pembimbing1->nl_metodologipenelitian ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">
                                            {{ $pembimbing2->nl_metodologipenelitian ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">
                                            {{ $penguji->nl_metodologipenelitian ?? 'Belum Dinilai' }}
                                        </td>
                                    </tr>
                                    <!-- Penggunaan Bahasa dan Tata Tulis -->
                                    <tr>
                                        <td class="text-center">4</td>
                                        <td>Penggunaan Bahasa dan Tata Tulis</td>
                                        <td>Mahasiswa mampu menyusun naskah proposal menggunakan ejaan bahasa
                                            Indonesia yang
                                            baik dan benar, serta mengikuti aturan dan panduan penulisan.</td>
                                        <td class="text-center">
                                            {{ $pembimbing1->nl_bahasadantatatulis ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">
                                            {{ $pembimbing2->nl_bahasadantatatulis ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">
                                            {{ $penguji->nl_bahasadantatatulis ?? 'Belum Dinilai' }}
                                        </td>
                                    </tr>
                                    <!-- Presentasi -->
                                    <tr>
                                        <td class="text-center">5</td>
                                        <td>Presentasi</td>
                                        <td>Komunikatif, ketepatan waktu, kejelasan, dan keruntunan dalam
                                            penyampaian
                                            materi.</td>
                                        <td class="text-center">
                                            {{ $pembimbing1->nl_presentasi ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">
                                            {{ $pembimbing2->nl_presentasi ?? 'Belum Dinilai' }}</td>
                                        <td class="text-center">{{ $penguji->nl_presentasi ?? 'Belum Dinilai' }}
                                        </td>
                                    </tr>

                                    <!-- Rata-rata Nilai -->
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-end bg-primary text-white">
                                            <strong>Rata-Rata Nilai</strong>
                                        </td>
                                        <td class="text-center">
                                            {{ number_format((($pembimbing1->nl_pendahuluan ?? 0) + ($pembimbing1->nl_tinjauanpustaka ?? 0) + ($pembimbing1->nl_metodologipenelitian ?? 0) + ($pembimbing1->nl_bahasadantatatulis ?? 0) + ($pembimbing1->nl_presentasi ?? 0)) / 5, 2, '.', '') }}
                                        </td>
                                        <td class="text-center">
                                            {{ number_format((($pembimbing2->nl_pendahuluan ?? 0) + ($pembimbing2->nl_tinjauanpustaka ?? 0) + ($pembimbing2->nl_metodologipenelitian ?? 0) + ($pembimbing2->nl_bahasadantatatulis ?? 0) + ($pembimbing2->nl_presentasi ?? 0)) / 5, 2, '.', '') }}
                                        </td>
                                        <td class="text-center">
                                            {{ number_format((($penguji->nl_pendahuluan ?? 0) + ($penguji->nl_tinjauanpustaka ?? 0) + ($penguji->nl_metodologipenelitian ?? 0) + ($penguji->nl_bahasadantatatulis ?? 0) + ($penguji->nl_presentasi ?? 0)) / 5, 2, '.', '') }}
                                        </td>
                                    </tr>

                                    <!-- Nilai Seminar Proposal -->
                                    <tr class="bg-light">
                                        <td colspan="3" class="text-end bg-primary text-white">
                                            <strong>Nilai Seminar Proposal</strong>
                                        </td>
                                        <td class="text-center" colspan="3">
                                            {{ $item->nilaiakhir }}
                                        </td>
                                    </tr>

                                    <!-- Komentar -->
                                    <tr>
                                        <td colspan="6">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                    <th class="text-center bg-primary text-white" colspan="3">
                                                        Komentar
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width: 33.33%; text-align: center;">Pembimbing
                                                            Satu</td>
                                                        <td style="width: 33.33%; text-align: center;">Pembimbing
                                                            Dua</td>
                                                        <td style="width: 33.33%; text-align: center;">Penguji</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $pembimbing1->komentar }}</td>
                                                        <td>{{ $pembimbing2->komentar }}</td>
                                                        <td>{{ $penguji->komentar }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                @endforeach
            @endif
        @elseif (Gate::allows('isDosen'))
            <h2 class="mb-3">Pengajuan Seminar Proposal</h2>
            <table id="sempro" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSempro as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->tugasakhir->mahasiswa->namamhs }}</td>
                            <td>
                                <a href="/admin/sempro/detail/{{ $item->id }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif (Gate::allows('isKaprodi'))
            <h2 class="mb-3">Pengajuan Seminar Proposal</h2>
            <table id="sempro" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataSempro as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->tugasakhir->mahasiswa->namamhs }}</td>
                            <td>
                                <a href="/admin/sempro/detail/{{ $item->id }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
