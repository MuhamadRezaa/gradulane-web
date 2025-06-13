@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2 class="my-3">Form Edit Seminar Proposal</h2>

        <form method="post" action="/admin/sempro/{{ $sempro->id }}" enctype="multipart/form-data">
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
                    <label for="file_sempro" class="form-label">File Proposal</label>
                    <input type="file" class="form-control" id="file_sempro" name="file_sempro"
                        accept=".pdf, .doc, .docx">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti file. Lihat Dokumen lama?,
                        @if ($sempro->file_sempro)
                            <a href="{{ Storage::url($sempro->file_sempro) }}" target="_blank"> Klik Disini</a>
                        @endif
                    </small>
                    @error('file_sempro')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>

            <a href="/admin/sempro" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
