@extends('admin.layouts.template')
@section('main')
    <div class="card m-1 p-4">
        <h2 class="mb-4">Edit Penjadwalan Seminar Proposal</h2>

        <form method="post" action="/sempro/editpenjadwalan/{{ $sempro->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="width-75">

                <div class="mb-3">
                    <label for="mahasiswa_id" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="mahasiswa_id" name="mahasiswa_id"
                        value="{{ old('mahasiswa_id', $sempro->tugasakhir->mahasiswa->namamhs) }}" readonly>
                    <input type="hidden" name="mahasiswa_id" value="{{ old('mahasiswa_id', $sempro->mahasiswa_id) }}">
                    @error('mahasiswa_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tugasakhir_id" class="form-label">Judul Proposal</label>
                    <input type="text" class="form-control" id="tugasakhir_id" name="tugasakhir_id"
                        value="{{ old('tugasakhir_id', $sempro->tugasakhir->pilihjudul) }}" readonly>
                    <input type="hidden" name="tugasakhir_id" value="{{ old('tugasakhir_id', $sempro->tugasakhir_id) }}">
                    @error('tugasakhir_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pengujisempro_id" class="form-label">Dosen Penguji</label>
                    <select class="form-select select-pembimbing" id="pengujisempro_id" name="pengujisempro_id" required>
                        <option value="">-- Pilih Dosen Penguji --</option>
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}"
                                {{ old('pengujisempro_id', $sempro->pengujisempro_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->namadosen }}
                            </option>
                        @endforeach
                    </select>
                    @error('pengujisempro_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tgl_sempro" class="form-label">Tanggal & Waktu Seminar Proposal</label>
                    <div class="row">
                        <!-- Input tanggal -->
                        <div class="col-md-6">
                            <input type="date" class="form-control @error('tgl_sempro') is-invalid @enderror"
                                id="tgl_sempro" name="tgl_sempro"
                                value="{{ old('tgl_sempro', isset($sempro) ? $sempro->tgl_sempro : '') }}" required>
                            @error('tgl_sempro')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Input sesi -->
                        <div class="col-md-6">
                            <select class="form-select @error('sesi_id') is-invalid @enderror" id="sesi_id" name="sesi_id"
                                required>
                                <option value="">-- Pilih Sesi --</option>
                                @foreach ($sesi as $item)
                                    <option value="{{ $item->id }}"
                                        {{ old('sesi_id', isset($sempro) ? $sempro->sesi_id : '') == $item->id ? 'selected' : '' }}>
                                        {{ $item->namasesi }} : {{ date('H:i', strtotime($item->waktumulai)) }}
                                        - {{ date('H:i', strtotime($item->waktuakhir)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sesi_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ruangan_id" class="form-label">Ruangan</label>
                    <select class="form-select select-pembimbing" id="ruangan_id" name="ruangan_id" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach ($ruangan as $item)
                            <option value="{{ $item->id }}"
                                {{ old('ruangan_id', $sempro->ruangan_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->koderuangan }}-{{ $item->namaruangan }}
                            </option>
                        @endforeach
                    </select>
                    @error('ruangan_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <a href="/admin/sempro/detail/{{ $sempro->id }}" class="btn btn-primary my-3 col-1 d-inline-block"
                style="width:auto">Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
