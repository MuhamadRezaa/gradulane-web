@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah User Baru</h2>
        <div class="">
            <a href="/admin/user" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/user">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="namalengkap" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('namalengkap') is-invalid @enderror" id="namalengkap"
                        name="namalengkap" value="{{ old('namalengkap') }}">
                    @error('namalengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIM -->
                <div class="mb-3">
                    <label for="nim" class="form-label">NIM</label>
                    <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim"
                        name="nim" value="{{ old('nim') }}">
                    <small class="text-muted">Hanya untuk mahasiswa</small>
                    @error('nim')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

                <!-- Foto -->
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                        name="foto" accept=".jpg, .jpeg, .png">
                    @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="level" class="form-label">Level User</label>
                    <select class="form-select" id="level" name="level">
                        <option value="" disabled selected>Pilih Level User</option>
                        <option value="admin" {{ old('level') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="kajur" {{ old('level') == 'kajur' ? 'selected' : '' }}>Kepala Jurusan</option>
                        <option value="kaprodi" {{ old('level') == 'kaprodi' ? 'selected' : '' }}>Kepala Program Studi
                        </option>
                        <option value="dosen" {{ old('level') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                        <option value="mahasiswa" {{ old('level') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                        </option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
