@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h1>Update Data</h1>
        <div class="">
            <a href="/admin/ruangan" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/ruangan/{{ $ruangan->id }}">
            @csrf
            @method('put')
            <div class="width-75">
                <div class="mb-3">
                    <label for="koderuangan" class="form-label">Kode Ruangan</label>
                    <input type="text" class="form-control" id="koderuangan" name="koderuangan"
                        value="{{ $ruangan->koderuangan }}">
                </div>
                <div class="mb-3">
                    <label for="namaruangan" class="form-label">Nama Ruangan</label>
                    <input type="text" class="form-control" id="namaruangan" name="namaruangan"
                        value="{{ $ruangan->namaruangan }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
