@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h1>Update Data</h1>
        <div class="">
            <a href="/admin/tahunajaran" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/tahunajaran/{{ $tahunajaran->id }}">
            @csrf
            @method('put')
            <div class="width-75">
                <div class="mb-3">
                    <label for="tahunajaran" class="form-label">Nama Program Studi</label>
                    <input type="text" class="form-control" id="tahunajaran" name="tahunajaran"
                        value="{{ $tahunajaran->tahunajaran }}">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="" disabled>Pilih Status</option>
                        <option value="Aktif" {{ $tahunajaran->status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Tidak Aktif" {{ $tahunajaran->status === 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                            Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
