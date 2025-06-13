@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">

        <h5 class="mb-3">Daftar Sidang Tugas Akhir</h5>
        <p>Dengan melakukan upload Dokumen, ini berarti anda mengajukan permintaan untuk melakukan Sidang Tugas Akhir.
            Pastikan anda Mengupload Dokumen anda</p>
        <form method="post" action="/sita" enctype="multipart/form-data">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="dokumen" class="form-label">Upload Dokumen</label>
                    <input class="form-control @error('dokumen') is-invalid @enderror" type="file" id="dokumen"
                        name="dokumen" accept=".pdf" onchange="previewImage(event)" required>
                    <div id="fileHelp" class="form-text">Pastikan file adalah PDF</div>
                    @error('dokumen')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary float-end mx-1">Submit</button>
            <a href="/sita" class="btn btn-primary float-end">Kembali</a>
        </form>
    </div>
@endsection
