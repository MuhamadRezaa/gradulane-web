@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah Mahasiswa Baru</h2>
        <div class="mb-3">
            <a href="/admin/mahasiswa" class="btn btn-primary my-3" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/mahasiswa" enctype="multipart/form-data">
            @csrf
            <div class="width-75">
                <!-- Nama Mahasiswa -->
                <div class="mb-3">
                    <label for="namamhs" class="form-label">Nama Mahasiswa</label>
                    <input type="text" class="form-control @error('namamhs') is-invalid @enderror" id="namamhs"
                        name="namamhs" value="{{ old('namamhs') }}">
                    @error('namamhs')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIM -->
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                        name="nim" value="{{ old('nim') }}">
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- kelas -->
                <div class="mb-3">
                    <label for="kelas" class="form-label">Kelas</label>
                    <select class="form-select @error('kelas') is-invalid @enderror" id="kelas" name="kelas" required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="A" {{ old('kelas') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ old('kelas') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="C" {{ old('kelas') == 'C' ? 'selected' : '' }}>C</option>
                        <option value="D" {{ old('kelas') == 'D' ? 'selected' : '' }}>D</option>
                    </select>
                    @error('kelas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div class="mb-3">
                    <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                    <div class="mx-2">
                        <div class="form-check">
                            <input class="form-check-input @error('jeniskelamin') is-invalid @enderror" type="radio"
                                name="jeniskelamin" id="Laki-laki" value="L"
                                {{ old('jeniskelamin', 'L') == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Laki-laki">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('jeniskelamin') is-invalid @enderror" type="radio"
                                name="jeniskelamin" id="Perempuan" value="P"
                                {{ old('jeniskelamin') == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Perempuan">
                                Perempuan
                            </label>
                        </div>
                        @error('jeniskelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Jurusan -->
                <div class="mb-3">
                    <label for="jurusan_id" class="form-label">Jurusan</label>
                    <select class="form-select @error('jurusan_id') is-invalid @enderror" id="jurusan" name="jurusan_id">
                        <option value="" disabled selected>Pilih Jurusan</option>
                        @foreach ($jurusan as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->namajurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Program Studi -->
                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Prodi</label>
                    <select class="form-select @error('prodi_id') is-invalid @enderror" id="prodi" name="prodi_id">
                        <option value="" disabled selected>Pilih Prodi</option>
                        {{-- @foreach ($prodi as $prodi)
                            <option value="{{ $prodi->id_prodi }}">{{ $prodi->namaprodi }}</option>
                        @endforeach --}}
                    </select>
                    @error('prodi_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                        name="foto" accept=".jpg, .jpeg, .png">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
