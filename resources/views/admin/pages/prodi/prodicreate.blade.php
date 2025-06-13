@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah prodi Baru</h2>
        <div class="">
            <a href="/admin/prodi" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/prodi">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="jurusan_id" class="form-label">Jurusan</label>
                    <br>
                    <select name="jurusan_id" class="form-select text-secondary">
                        <option value="- Pilih Jurusan -" disabled selected>Pilih Jurusan</option>
                        @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}">{{ $item->namajurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="namajenjang" class="form-label">Nama Jenjang</label>
                    <select class="form-select" id="namajenjang" name="namajenjang">
                        <option value="" disabled selected>Pilih Jenjang</option>
                        <option value="D-II" {{ old('namajenjang') == 'D-II' ? 'selected' : '' }}>D-II</option>
                        <option value="D-III" {{ old('namajenjang') == 'D-III' ? 'selected' : '' }}>D-III</option>
                        <option value="D-IV" {{ old('namajenjang') == 'D-IV' ? 'selected' : '' }}>D-IV</option>
                        <option value="S-2" {{ old('namajenjang') == 'S-2' ? 'selected' : '' }}>S-2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="namaprodi" class="form-label">Nama prodi</label>
                    <input type="text" class="form-control" id="namaprodi" name="namaprodi">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
