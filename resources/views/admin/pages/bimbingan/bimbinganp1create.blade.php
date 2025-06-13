@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah Bimbingan</h2>
        <div class="">
            <a href="/admin/bimbingan/detail/{{ $bimbingan->id }}" class="btn btn-primary my-3 col-1 d-inline-block"
                style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/bimbingan/tambahpembahasanp1">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="mahasiswa_id" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="mahasiswa_id" name="mahasiswa_id"
                        value="{{ $mahasiswa->namamhs }}" readonly>
                    <input type="hidden" name="mahasiswa_id" value="{{ $mahasiswa->id }}">
                    @error('mahasiswa_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tugasakhir_id" class="form-label">Judul Tugas Akhir</label>
                    <input type="text" class="form-control" id="tugasakhir_id" name="tugasakhir_id"
                        value="{{ $bimbingan->pilihjudul }}" readonly>
                    <input type="hidden" name="tugasakhir_id" value="{{ $bimbingan->id }}">
                    @error('tugasakhir_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pembimbing_id" class="form-label">Dosen Pembimbing 1</label>
                    <input type="text" class="form-control" id="pembimbing1_id" name="pembimbing_id"
                        value="{{ $bimbingan->pembimbingta1->namadosen }}" readonly>
                    <input type="hidden" name="pembimbing_id" value="{{ $bimbingan->pembimbingta1->id }}">
                    @error('pembimbing_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tglbimbingan" class="form-label">Tanggal Bimbingan</label>
                    <input type="date" class="form-control" id="tglbimbingan" rows="3" name="tglbimbingan">
                    @error('tglbimbingan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pembahasan" class="form-label">Pembahasan</label>
                    <textarea class="form-control" id="pembahasan" rows="3" name="pembahasan"></textarea>
                    @error('pembahasan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
