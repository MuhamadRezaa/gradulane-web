@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        @can('isMahasiswa')
            <div class="table-responsive">
                <h2 class="my-3">Data Pengajuan Sidang TA</h2>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            @if ($sita->status == 0)
                                <th class="text-center bg-primary text-white">Detail</th>
                                <th colspan="2" class="text-center">
                                    <a href="/sita/{{ $sita->id }}/edit" class="link">Ubah Pengajuan</a>
                                </th>
                            @else
                                <th colspan="3" class="text-center bg-primary text-white">Detail</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Judul Proposal</td>
                            <td colspan="2">{{ $sita->sitatugasakhir->pilihjudul }}</td>
                        </tr>
                        <tr>
                            <td>Verifikasi Pembimbing 1</td>
                            <td colspan="2">
                                @if ($sita->pembimbing1_acc === 0)
                                    {{ $sita->sitatugasakhir->pembimbingta1->namadosen }} - Belum Diverifikasi
                                @else
                                    {{ $sita->sitatugasakhir->pembimbingta1->namadosen }} - Sudah Diverifikasi
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Verifikasi Pembimbing 2</td>
                            <td colspan="2">
                                @if ($sita->pembimbing2_acc === 0)
                                    {{ $sita->sitatugasakhir->pembimbingta2->namadosen }} - Belum Diverifikasi
                                @else
                                    {{ $sita->sitatugasakhir->pembimbingta2->namadosen }} - Sudah Diverifikasi
                                @endif
                            </td>
                        </tr>
                        @if ($sita->penguji1_id != 0 && $sita->penguji2_id)
                            <tr>
                                <td>Penguji Satu</td>
                                <td colspan="2">{{ $sita->penguji1sita->namadosen }}</td>
                            </tr>
                            <tr>
                                <td>Penguji Dua</td>
                                <td colspan="2">{{ $sita->penguji2sita->namadosen }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Sidang</td>
                                <td colspan="2">
                                    {{ \Carbon\Carbon::parse($sita->tgl_sita)->locale('id')->translatedFormat('l, d F Y') }}
                                    - {{ $sita->sesisidang->namasesi }}:
                                    {{ \Carbon\Carbon::parse($sita->sesisidang->waktumulai)->translatedFormat('H:i') }}-{{ \Carbon\Carbon::parse($sita->sesisidang->waktuakhir)->translatedFormat('H:i') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Ruangan Sidang</td>
                                <td colspan="2">{{ $sita->ruangansita->koderuangan }} -
                                    {{ $sita->ruangansita->namaruangan }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td>Dokumen Proposal</td>
                            <td colspan="2"><a href="/proposaltadownload/{{ $sita->tugasakhir_id }}">Unduh Dokumen</a></td>
                        </tr>
                        <tr>
                            @if ($sita->status == 1)
                                <td>Status</td>
                                <td>Sedang Diajukan</td>
                            @elseif($sita->status == 2)
                                <td>Status</td>
                                <td>Sudah Divalidasi</td>
                            @elseif($sita->status == 3)
                                <td>Status</td>
                                <td>Dijadwalkan</td>
                            @elseif($sita->status == 4)
                                <td>Status</td>
                                <td>Sedang Sidang</td>
                            @elseif($sita->status == 5)
                                <td>Status</td>
                                <td>Sedang Dinilai</td>
                            @elseif($sita->status == 6)
                                <td>Nilai Akhir</td>
                                <td>{{ $sita->nilaiakhir }} - Lulus</td>
                            @elseif($sita->status == 7)
                                <td>Status</td>
                                <td>Tidak Lulus, <a href="/sita/create">Daftar Lagi??</a></td>
                            @endif
                        </tr>


                    </tbody>
                </table>
            </div>


            @if ($sita->status == 6 || $sita->status == 7)
                <h3 class="my-3">Detail Penilaian</h3>
                <div class="table-responsive my-3">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th class="bg-primary text-white">Kriteria</th>
                                <th class="bg-primary text-white">Deskripsi</th>
                                <th class="bg-primary text-white">Bobot</th>
                                <th class="bg-primary text-white" width="10%">Pembimbing Satu</th>
                                <th class="bg-primary text-white" width="10%">Pembimbing Dua</th>
                                <th class="bg-primary text-white" width="10%">Penguji Satu</th>
                                <th class="bg-primary text-white" width="10%">Penguji Dua</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Makalah Section -->
                            <tr>
                                <td colspan="7" class="bg-primary text-white">Makalah (40%)</td>
                            </tr>
                            <tr>
                                <td>Identifikasi Masalah</td>
                                <td>Tujuan dan kontribusi penelitian.</td>
                                <td class="text-center">5%</td>
                                <td class="text-center">{{ $pembimbing1->nl_identifikasimasalah ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_identifikasimasalah ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_identifikasimasalah ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_identifikasimasalah ?? 'Belum Dinilai' }}</td>
                            </tr>
                            <tr>
                                <td>Relevansi Teori</td>
                                <td>Referensi pustaka dan konsep dengan masalah penelitian.</td>
                                <td class="text-center">5%</td>
                                <td class="text-center">{{ $pembimbing1->nl_relevansiteori ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_relevansiteori ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_relevansiteori ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_relevansiteori ?? 'Belum Dinilai' }}</td>
                            </tr>
                            <tr>
                                <td>Metodologi Penelitian</td>
                                <td>Keselarasan metode dengan masalah penelitian.</td>
                                <td class="text-center">10%</td>
                                <td class="text-center">{{ $pembimbing1->nl_metodologipenelitian ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_metodologipenelitian ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_metodologipenelitian ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_metodologipenelitian ?? 'Belum Dinilai' }}</td>
                            </tr>
                            <tr>
                                <td>Hasil dan Pembahasan</td>
                                <td>Uraian hasil penelitian secara terperinci.</td>
                                <td class="text-center">10%</td>
                                <td class="text-center">{{ $pembimbing1->nl_hasilpembahasan ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_hasilpembahasan ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_hasilpembahasan ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_hasilpembahasan ?? 'Belum Dinilai' }}</td>
                            </tr>
                            <tr>
                                <td>Kesimpulan dan Sarana</td>
                                <td>Kesimpulan logis dan relevan dengan tujuan penelitian.</td>
                                <td class="text-center">5%</td>
                                <td class="text-center">{{ $pembimbing1->nl_kesimpulansarana ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_kesimpulansarana ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_kesimpulansarana ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_kesimpulansarana ?? 'Belum Dinilai' }}</td>
                            </tr>
                            <tr>
                                <td>Penggunaan Bahasa</td>
                                <td>Kesesuaian tata tulis dan bahasa.</td>
                                <td class="text-center">5%</td>
                                <td class="text-center">{{ $pembimbing1->nl_bahasatatatulis ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_bahasatatatulis ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_bahasatatatulis ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_bahasatatatulis ?? 'Belum Dinilai' }}</td>
                            </tr>

                            <!-- Presentasi Section -->
                            <tr>
                                <td colspan="7" class="bg-primary text-white">Presentasi (30%)</td>
                            </tr>
                            <tr>
                                <td>Sikap dan Penampilan</td>
                                <td>Keberanian, sikap, dan kesopanan saat presentasi.</td>
                                <td class="text-center">5%</td>
                                <td class="text-center">{{ $pembimbing1->nl_sikappenampilan ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_sikappenampilan ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_sikappenampilan ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_sikappenampilan ?? 'Belum Dinilai' }}</td>
                            </tr>
                            <tr>
                                <td>Komunikasi</td>
                                <td>Kejelasan dan runtutan sistematika.</td>
                                <td class="text-center">5%</td>
                                <td class="text-center">{{ $pembimbing1->nl_komunikasisistematika ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_komunikasisistematika ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_komunikasisistematika ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_komunikasisistematika ?? 'Belum Dinilai' }}</td>
                            </tr>
                            <tr>
                                <td>Penguasaan Materi</td>
                                <td>Kemampuan memahami dan menjawab pertanyaan.</td>
                                <td class="text-center">20%</td>
                                <td class="text-center">{{ $pembimbing1->nl_penguasaanmateri ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_penguasaanmateri ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_penguasaanmateri ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_penguasaanmateri ?? 'Belum Dinilai' }}</td>
                            </tr>

                            <!-- Produk Section -->
                            <tr>
                                <td colspan="7" class="bg-primary text-white">Produk (30%)</td>
                            </tr>
                            <tr>
                                <td>Fungsionalitas Sistem</td>
                                <td>Keselarasan fungsi dengan tujuan yang direncanakan.</td>
                                <td class="text-center">30%</td>
                                <td class="text-center">{{ $pembimbing1->nl_kesesuaianfungsi ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $pembimbing2->nl_kesesuaianfungsi ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji1->nl_kesesuaianfungsi ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">{{ $penguji2->nl_kesesuaianfungsi ?? 'Belum Dinilai' }}</td>
                            </tr>

                            <!-- Total Nilai -->
                            <tr>
                                <td colspan="3" class="text-end align-middle bg-primary text-white">
                                    <strong>Total Nilai</strong>
                                </td>
                                <td>{{ $pembimbing1->totalnilai ?? 'Belum Dinilai' }}</td>
                                <td>{{ $pembimbing2->totalnilai ?? 'Belum Dinilai' }}</td>
                                <td>{{ $penguji1->totalnilai ?? 'Belum Dinilai' }}</td>
                                <td>{{ $penguji2->totalnilai ?? 'Belum Dinilai' }}</td>
                            </tr>

                            <!-- Nilai Akhir -->
                            <tr>
                                <td colspan="3" class="text-end align-middle bg-primary text-white">
                                    <strong>Nilai Akhir</strong>
                                </td>
                                <td colspan="4" class="text-center">{{ $sita->nilaiakhir ?? 'Belum Dinilai' }}</td>
                            </tr>

                            <!-- Komentar -->
                            <tr>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <th colspan="7" class="text-center bg-primary text-white">Komentar</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pembimbing Satu</td>
                                            <td>Pembimbing Dua</td>
                                            <td>Penguji Satu</td>
                                            <td>Penguji Dua</td>
                                        </tr>
                                        <tr>
                                            <td>{{ $pembimbing1->komentar ?? 'Tidak Ada Komentar' }}</td>
                                            <td>{{ $pembimbing2->komentar ?? 'Tidak Ada Komentar' }}</td>
                                            <td>{{ $penguji1->komentar ?? 'Tidak Ada Komentar' }}</td>
                                            <td>{{ $penguji2->komentar ?? 'Tidak Ada Komentar' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @endcan

        @can('isAdmin')
            <h2>Data Sidang Tugas Akhir</h2>
            <div class="table-responsive">
                <table id="example2" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->sitatugasakhir->mahasiswa->namamhs }}</td>
                                <td>
                                    <a href="/detailsita/{{ $item->id }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endcan

        @can('isDosen')
            <h2>Data Sidang Tugas Akhir</h2>
            <div class="table-responsive">
                <table id="example2" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sita as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->sitatugasakhir->mahasiswa->namamhs }}</td>
                                <td>
                                    <a href="/detailsita/{{ $item->id }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endcan

        @can('isKaprodi')
            <h2>Data Sidang Tugas Akhir</h2>
            <div class="table-responsive">
                <table id="example2" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sita as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->sitatugasakhir->mahasiswa->namamhs }}</td>
                                <td>
                                    <a href="/detailsita/{{ $item->id }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endcan
    </div>
@endsection
