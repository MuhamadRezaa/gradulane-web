@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah Pangkat Baru</h2>
        <div class="">
            <a href="/admin/pangkat" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/pangkat">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="namapangkat" class="form-label">Nama Pangkat</label>
                    <input type="text" class="form-control" id="namapangkat" name="namapangkat">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
