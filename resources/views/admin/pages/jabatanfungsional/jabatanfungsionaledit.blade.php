@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h1>Update Data</h1>
        <div class="">
            <a href="/admin/jabatanfungsional" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/jabatanfungsional/{{ $jabatanfungsional->id }}">
            @csrf
            @method('put')
            <div class="width-75">
                <div class="mb-3">
                    <label for="jabatanfungsional" class="form-label">Jabatan Fungsional</label>
                    <input type="text" class="form-control" id="jabatanfungsional" name="jabatanfungsional"
                        value="{{ $jabatanfungsional->jabatanfungsional }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
