@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah Jenjang Baru</h2>
        <div class="">
            <a href="/admin/jenjang" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/jenjang">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="namajenjang" class="form-label">Nama Jenjang</label>
                    <input type="text" class="form-control" id="namajenjang" name="namajenjang">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
