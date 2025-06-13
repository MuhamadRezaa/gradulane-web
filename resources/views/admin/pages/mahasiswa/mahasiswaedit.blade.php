@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Edit Data Mahasiswa</h2>
        <div class="">
            <a href="/admin/mahasiswa" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/mahasiswa/{{ $mahasiswa->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Menandakan bahwa ini adalah permintaan PUT -->
            <div class="width-75">
                <div class="mb-3">
                    <label for="namamhs" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control" id="namamhs" name="namamhs"
                        value="{{ old('namamhs', $mahasiswa->namamhs) }}">
                </div>
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control" id="nim" name="nim"
                        value="{{ old('nim', $mahasiswa->nim) }}">
                </div>

                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-select @error('kelas') is-invalid @enderror" id="kelas" name="kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="A" {{ (old('kelas') ?? $mahasiswa->kelas) == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ (old('kelas') ?? $mahasiswa->kelas) == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ (old('kelas') ?? $mahasiswa->kelas) == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ (old('kelas') ?? $mahasiswa->kelas) == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                    <div class="mx-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-laki" value="L"
                                {{ old('jeniskelamin', $mahasiswa->jeniskelamin) == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Laki-laki">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan" value="P"
                                {{ old('jeniskelamin', $mahasiswa->jeniskelamin) == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Perempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ old('email', $mahasiswa->email) }}">
                </div>

                <div class="mb-3">
                    <label for="jurusan_id" class="form-label">Jurusan</label>
                    <select class="form-select" id="jurusan" name="jurusan_id"
                        data-selected-prodi="{{ old('prodi_id', $mahasiswa->prodi_id) }}">>
                        @foreach ($jurusan as $jurusan)
                            <option value="{{ $jurusan->id }}"
                                {{ old('jurusan_id', $mahasiswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->namajurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Program Studi</label>
                    <select class="form-select" id="prodi" name="prodi_id">
                        @foreach ($prodi as $prodi)
                            {{-- <option value="{{ $prodi->id_prodi }}"
                                {{ old('prodi_id', $mahasiswa->prodi_id) == $prodi->id_prodi ? 'selected' : '' }}>
                                {{ $prodi->namajenjang }} {{ $prodi->namaprodi }}
                            </option> --}}
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    @if ($mahasiswa->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Mahasiswa"
                                class="img-thumbnail" style="width: 300px; height: auto;">
                        </div>
                    @else
                        <div class="mb-2">
                            <img src="{{ asset('storage/images/defaultfoto.png') }}" alt="Foto Mahasiswa"
                                class="img-thumbnail" style="width: 300px; height: auto;">
                        </div>
                    @endif
                    <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .jpeg, .png">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
