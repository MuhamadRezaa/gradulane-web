@extends('admin.layouts.template')
<style>
    /* Pastikan Select2 mengisi lebar penuh dalam container */
    /* .select2-container {
        width: 100% !important;
    } */


    .select2-container .select2-selection--single .select2-selection__rendered {
        display: flex;
        align-items: center;
    }

    /* Penyesuaian elemen select */
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px);
        /* Tinggi seperti elemen form Bootstrap */
        padding: 0.375rem 0.75rem;
        border: 1px solid #ced4da;
        /* Warna border seperti form */
        border-radius: 0.375rem;
        /* Border radius seperti Bootstrap */
        background-color: #fff;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        box-sizing: border-box;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        display: flex;
        align-items: center;
        white-space: nowrap;
        /* Hindari teks terpotong */
        overflow: hidden;
        /* Potong teks panjang */
        text-overflow: ellipsis;
        /* Tambahkan elipsis untuk teks panjang */
    }

    /* Responsif dropdown Select2 */
    .select2-container--bootstrap-5 .select2-dropdown {
        width: auto !important;
        /* Sesuaikan lebar dengan konten */
        max-width: 100%;
        /* Hindari overflow */
        min-width: 0;
        box-sizing: border-box;
        /* Perhitungan lebar */
    }

    /* Penyesuaian dropdown pada perangkat kecil */
    @media (max-width: 576px) {
        .select2-container--bootstrap-5 .select2-dropdown {
            width: 100% !important;
            max-width: 100%;
            /* Hindari dropdown keluar layar */
        }
    }

    /* Tambahkan scroll jika opsi terlalu banyak */
    .select2-container--bootstrap-5 .select2-results__options {
        max-height: 300px;
        overflow-y: auto;
    }

    /* Menyesuaikan tampilan isi dropdown */
    .select2-container--bootstrap-5 .select2-results__option {
        font-size: 1rem;
        padding: 0.375rem 1rem;
        /* Padding opsi dropdown */
    }

    /* Penyesuaian badge untuk opsi dropdown */
    .option-item {
        display: flex;
        flex-direction: column;
        /* Badge berada di bawah nama */
    }

    .badge-container {
        margin-top: 5px;
        /* Jarak antara nama dan badge */
    }

    .badge {
        margin-right: 5px;
        /* Jarak antar badge */
        margin-bottom: 5px;
        /* Jarak bawah */
        font-size: 0.75rem;
    }
</style>

@section('main')
    <div class="card m-1 p-4">
        <h2>Review Proposal Tugas Akhir Mahasiswa</h2>
        <div class="">
            <a href="/admin/tugasakhir/detail/{{ $tugasAkhir->id }}" class="btn btn-primary my-3 col-1 d-inline-block"
                style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/tugasakhir/review/{{ $tugasAkhir->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="width-75">
                <div class="mb-3">
                    <label for="mahasiswa_id" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="mahasiswa_id" name="mahasiswa_id"
                        value="{{ $tugasAkhir->mahasiswa->namamhs }}" readonly>
                    @error('mahasiswa_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if ($tugasAkhir->status_usulan == '0' || $tugasAkhir->status_usulan == '5')
                    <div class="mb-3">
                        <label for="pilihjudul" class="form-label">Pilih Judul</label>
                        <select class="form-select" id="pilihjudul" name="pilihjudul">
                            <option value="">-- Pilih Judul Proposal Mahasiswa --</option>
                            <option value="{{ $tugasAkhir->judul1 }}">Judul 1: {{ $tugasAkhir->judul1 }}</option>
                            <option value="{{ $tugasAkhir->judul2 }}">Judul 2: {{ $tugasAkhir->judul2 }}</option>
                        </select>
                        @error('pilihjudul')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                        <select class="form-select select-pembimbing" id="pembimbing1" name="pembimbing1" required>
                            <option value="">-- Pilih Dosen Pembimbing 1 --</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}"
                                    data-bidang="{{ json_encode($item->bidangs->pluck('namabidang')->toArray()) }}">
                                    {{ $item->namadosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembimbing1')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pembimbing2" class="form-label">Pembimbing 2</label>
                        <select class="form-select select-pembimbing" id="pembimbing2" name="pembimbing2" required>
                            <option value="">-- Pilih Dosen Pembimbing 2 --</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}"
                                    data-bidang="{{ json_encode($item->bidangs->pluck('namabidang')->toArray()) }}">
                                    {{ $item->namadosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembimbing2')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reviewta" class="form-label">Komentar</label>
                        <textarea class="form-control" id="reviewta" rows="3" name="reviewta">{{ old('reviewta') }}</textarea>
                        @error('reviewta')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @else
                    <div class="mb-3">
                        <label for="pilihjudul" class="form-label">Pilih Judul</label>
                        <select class="form-select" id="pilihjudul" name="pilihjudul">
                            <option value="">-- Pilih Judul Proposal Mahasiswa --</option>
                            <option value="{{ $tugasAkhir->judul1 }}"
                                {{ $tugasAkhir->pilihjudul == $tugasAkhir->judul1 ? 'selected' : '' }}>
                                Judul 1: {{ $tugasAkhir->judul1 }}
                            </option>
                            <option value="{{ $tugasAkhir->judul2 }}"
                                {{ $tugasAkhir->pilihjudul == $tugasAkhir->judul2 ? 'selected' : '' }}>
                                Judul 2: {{ $tugasAkhir->judul2 }}
                            </option>
                        </select>
                        @error('pilihjudul')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pembimbing1" class="form-label">Pembimbing 1</label>
                        <select class="form-select select-pembimbing" id="pembimbing1" name="pembimbing1" required>
                            <option value="">-- Pilih Dosen Pembimbing 1 --</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}"
                                    data-bidang="{{ json_encode($item->bidangs->pluck('namabidang')->toArray()) }}"
                                    {{ $item->id == $tugasAkhir->pembimbing1 ? 'selected' : '' }}>
                                    {{ $item->namadosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembimbing1')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="pembimbing2" class="form-label">Pembimbing 2</label>
                        <select class="form-select select-pembimbing" id="pembimbing2" name="pembimbing2" required>
                            <option value="">-- Pilih Dosen Pembimbing 2 --</option>
                            @foreach ($dosen as $item)
                                <option value="{{ $item->id }}"
                                    data-bidang="{{ json_encode($item->bidangs->pluck('namabidang')->toArray()) }}"
                                    {{ $item->id == $tugasAkhir->pembimbing2 ? 'selected' : '' }}>
                                    {{ $item->namadosen }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembimbing2')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="reviewta" class="form-label">Komentar</label>
                        <textarea class="form-control" id="reviewta" rows="3" name="reviewta">{{ old('reviewta', $tugasAkhir->reviewta) }}</textarea>
                        @error('reviewta')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @endif

                <button type="submit" class="btn btn-success" name="hasil" value="1">Diterima</button>
                <button type="submit" class="btn btn-primary" name="hasil" value="2">Revisi</button>
                <button type="submit" class="btn btn-danger" name="hasil" value="3">Ditolak</button>
        </form>
    </div>

@endsection
