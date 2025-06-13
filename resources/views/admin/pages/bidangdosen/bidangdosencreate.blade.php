@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah Bidang Dosen</h2>
        <a href="{{ route('bidangdosen.index') }}" class="btn btn-primary my-3 col-1 d-inline-block"
            style="width:auto">Kembali</a>

        <form action="{{ route('bidangdosen.store') }}" method="POST">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="dosen_id" class="form-label">Nama Dosen</label>
                    <select class="form-select" id="dosen_id" name="dosen_id" required>
                        <option value="">Pilih Dosen</option>
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->namadosen }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="bidang_id">Bidang</label>
                    <div id="bidang_id" class="d-flex flex-wrap gap-2">
                        @foreach ($bidangs as $bidang)
                            <input type="checkbox" class="btn-check" id="bidang{{ $bidang->id }}" name="bidang_id[]"
                                value="{{ $bidang->id }}" autocomplete="off">
                            <label class="btn btn-outline-primary"
                                for="bidang{{ $bidang->id }}">{{ $bidang->namabidang }}</label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </div>
        </form>
    </div>
@endsection
