@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah jabatan Baru</h2>
        <div class="">
            <a href="/admin/jabatan" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/jabatan">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="namajabatan" class="form-label">Nama jabatan</label>
                    <input type="text" class="form-control" id="namajabatan" name="namajabatan">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
