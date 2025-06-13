@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Edit Tugas Akhir</h2>
        <div class="">
            <a href="/admin/tugasakhir" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/tugasakhir/{{ $tugasAkhir->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="width-75">
                <div class="mb-3">
                    <label for="mahasiswa_id" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="mahasiswa_id" name="mahasiswa_id"
                        value="{{ $mahasiswa->namamhs ?? 'Nama mahasiswa tidak tersedia' }}" readonly>
                    <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id ?? '' }}">
                    @error('mahasiswa_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                @if ($tugasAkhir->pilihjudul == null)
                    <div class="mb-3">
                        <label for="judul1" class="form-label">Judul 1</label>
                        <input type="text" class="form-control" id="judul1" name="judul1"
                            value="{{ old('judul1', $tugasAkhir->judul1) }}">
                        @error('judul1')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="judul2" class="form-label">Judul 2</label>
                        <input type="text" class="form-control" id="judul2" name="judul2"
                            value="{{ old('judul2', $tugasAkhir->judul2) }}">
                        @error('judul2')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @else
                    <div class="mb-3">
                        <label for="pilihjudul" class="form-label">Pilih Judul (Judul TA)</label>
                        <select class="form-select" id="pilihjudul" name="pilihjudul" disabled>
                            <option value="">-- Pilih Judul Proposal Mahasiswa --</option>
                            <option value="{{ $tugasAkhir->judul1 }}"
                                {{ old('pilihjudul', $tugasAkhir->pilihjudul) == $tugasAkhir->judul1 ? 'selected' : '' }}>
                                Judul 1: {{ $tugasAkhir->judul1 }}
                            </option>
                            <option value="{{ $tugasAkhir->judul2 }}"
                                {{ old('pilihjudul', $tugasAkhir->pilihjudul) == $tugasAkhir->judul2 ? 'selected' : '' }}>
                                Judul 2: {{ $tugasAkhir->judul2 }}
                            </option>
                        </select>

                        @error('pilihjudul')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                @endif

                <div class="mb-3">
                    <label for="dokumen_proposal1" class="form-label">Dokumen Proposal 1</label>
                    <input type="file" class="form-control" id="dokumen_proposal1" name="dokumen_proposal1"
                        accept=".pdf, .doc, .docx">
                    @error('dokumen_proposal1')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if ($tugasAkhir->pilihjudul == $tugasAkhir->judul1)
                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                            {{-- target="_blank" --}}>Download Dokumen</a>
                    @elseif ($tugasAkhir->pilihjudul == $tugasAkhir->judul2)
                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                            {{-- target="_blank" --}}>Download Dokumen</a>
                    @endif

                    @if ($tugasAkhir->dokumen_proposal1)
                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" target="_blank"
                            class="btn btn-link">Lihat Dokumen Saat Ini</a>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="dokumen_proposal2" class="form-label">Dokumen Proposal 2</label>
                    <input type="file" class="form-control" id="dokumen_proposal2" name="dokumen_proposal2"
                        accept=".pdf, .doc, .docx">
                    @error('dokumen_proposal2')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    @if ($tugasAkhir->pilihjudul == $tugasAkhir->judul1)
                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal1) }}" class="btn btn-primary"
                            {{-- target="_blank" --}}>Download Dokumen</a>
                    @elseif ($tugasAkhir->pilihjudul == $tugasAkhir->judul2)
                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" class="btn btn-primary"
                            {{-- target="_blank" --}}>Download Dokumen</a>
                    @endif

                    @if ($tugasAkhir->dokumen_proposal2)
                        <a href="{{ Storage::url($tugasAkhir->dokumen_proposal2) }}" target="_blank"
                            class="btn btn-link">Lihat Dokumen Saat Ini</a>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="cttmhs" class="form-label">Catatan</label>
                    <textarea class="form-control" id="cttmhs" rows="3" name="cttmhs">{{ old('cttmhs', $tugasAkhir->cttmhs) }}</textarea>
                    @error('cttmhs')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
