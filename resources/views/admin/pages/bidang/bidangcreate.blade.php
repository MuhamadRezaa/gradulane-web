@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah Bidang Baru</h2>
        <div class="">
            <a href="/admin/bidang" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/bidang">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="namabidang" class="form-label">Nama Bidang</label>
                    <input type="text" class="form-control" id="namabidang" name="namabidang">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
