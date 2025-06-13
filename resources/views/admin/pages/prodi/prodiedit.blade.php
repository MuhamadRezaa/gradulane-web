@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h1>Update Data</h1>
        <div class="">
            <a href="/admin/prodi" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/prodi/{{ $prodi->id_prodi }}">
            @csrf
            @method('put')
            <div class="width-75">
                <div class="mb-3">
                    <label for="jurusan_id" class="form-label">Jurusan</label>
                    <br>
                    <select name="jurusan_id" class="form-select text-secondary">
                        <option value="- Pilih Jurusan -" class="form-control">-</option>
                        @foreach ($jurusan as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $prodi->jurusan_id ? 'selected' : '' }}>
                                {{ $item->namajurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="namajenjang" class="form-label">Nama Jenjang</label>
                    <select class="form-select" id="namajenjang" name="namajenjang">
                        <option value="" disabled {{ old('namajenjang', $prodi->namajenjang) ? '' : 'selected' }}>
                            Pilih Jenjang</option>
                        <option value="D-II" {{ old('namajenjang', $prodi->namajenjang) == 'D-II' ? 'selected' : '' }}>
                            D-II</option>
                        <option value="D-III" {{ old('namajenjang', $prodi->namajenjang) == 'D-III' ? 'selected' : '' }}>
                            D-III</option>
                        <option value="D-IV" {{ old('namajenjang', $prodi->namajenjang) == 'D-IV' ? 'selected' : '' }}>
                            D-IV</option>
                        <option value="S-2" {{ old('namajenjang', $prodi->namajenjang) == 'S-2' ? 'selected' : '' }}>S-2
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="namaprodi" class="form-label">Nama Program Studi</label>
                    <input type="text" class="form-control" id="namaprodi" name="namaprodi"
                        value="{{ old('namaprodi', $prodi->namaprodi) }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
