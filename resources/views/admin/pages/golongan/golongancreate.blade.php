@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah golongan Baru</h2>
        <div class="">
            <a href="/admin/golongan" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/golongan">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="namagolongan" class="form-label">Nama golongan</label>
                    <input type="text" class="form-control" id="namagolongan" name="namagolongan">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
