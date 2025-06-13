@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Usulan Judul Tugas Akhir</h2>
        @if (Auth::user()->can('isMahasiswa'))
            @if ($data->count() <= 0)
                <div class="">
                    <h5>Belum ada pengajuan judul. Untuk melanjutkan, silakan ajukan judul Anda <strong><a
                                href="/admin/tugasakhir/create" class="mt-3" style="width:auto">di sini</a></strong>.</h5>
                </div>
            @else
                <table id="tugasakhir" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Mahasiswa</th>
                            <th>Status Pengajuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->mahasiswa->namamhs }}</td>
                                <td>
                                    @if ($item->status_usulan == '0')
                                        <span>Pengajuan</span>
                                    @elseif ($item->status_usulan == '1')
                                        <span>Diterima</span>
                                    @elseif ($item->status_usulan == '2')
                                        <span>Revisi</span>
                                    @elseif ($item->status_usulan == '3')
                                        <span>Ditolak</span>
                                    @elseif ($item->status_usulan == '4')
                                        <span>Diajukan Kembali</span>
                                    @elseif ($item->status_usulan == '5')
                                        <span>Sedang Diperiksa</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/tugasakhir/detail/{{ $item->id }}" class="btn btn-primary">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                    {{-- @if ($item->status_usulan == '0' || $item->status_usulan == '2' || $item->status_usulan == '3')
                                        <a href="/admin/tugasakhir/{{ $item->id }}/edit" class="btn btn-warning">Ubah
                                            Pengajuan</a>
                                    @endif --}}

                                    @if ($item->status_usulan == '0')
                                        <form action="/admin/tugasakhir/{{ $item->id }}" method="post"
                                            class="d-inline delete-form">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete-btn">Batalkan
                                                Pengajuan</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @elseif (Auth::user()->can('isKaprodi'))
            <table id="tugasakhir" class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Status Pengajuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->mahasiswa->namamhs }}</td>
                            <td>{{ $item->mahasiswa->nim }}</td>
                            <td>
                                @if ($item->status_usulan == '0')
                                    <span>Pengajuan</span>
                                @elseif ($item->status_usulan == '1')
                                    <span>Diterima</span>
                                @elseif ($item->status_usulan == '2')
                                    <span>Revisi</span>
                                @elseif ($item->status_usulan == '3')
                                    <span>Ditolak</span>
                                @elseif ($item->status_usulan == '4')
                                    <span>Diajukan Kembali</span>
                                @elseif ($item->status_usulan == '5')
                                    <span>Sedang Diperiksa</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="/admin/tugasakhir/detail/{{ $item->id }}" class="btn btn-primary">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                    @if ($item->status_usulan == '0')
                                        <form action="/admin/tugasakhir/mulaireview/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status_usulan" value="5">
                                            <button type="submit" class="btn btn-danger btn-mulaireview">Mulai
                                                Review</button>
                                        </form>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
