@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah level Baru</h2>
        <div class="">
            <a href="/admin/level" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/level">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="level" class="form-label">Nama level</label>
                    <input type="text" class="form-control" id="level" name="level">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
