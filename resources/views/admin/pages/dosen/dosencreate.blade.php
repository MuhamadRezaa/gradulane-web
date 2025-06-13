@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Tambah Dosen Baru</h2>
        <div class="mb-3">
            <a href="/admin/dosen" class="btn btn-primary my-3" style="width:auto">Kembali</a>
        </div>

        <form method="post" action="/admin/dosen" enctype="multipart/form-data">
            @csrf
            <div class="width-75">
                <div class="mb-3">
                    <label for="namadosen" class="form-label">Nama Dosen</label>
                    <input type="text" class="form-control" id="namadosen" name="namadosen"
                        value="{{ old('namadosen') }}" required>
                </div>

                <div class="mb-3">
                    <label for="nidn" class="form-label">NIDN</label>
                    <input type="text" class="form-control" id="nidn" name="nidn" value="{{ old('nidn') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="nip" class="form-label">NIP</label>
                    <input type="text" class="form-control" id="nip" name="nip" value="{{ old('nip') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat / Tanggal Lahir</label>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="tmpt_tgl_lahir" name="tmpt_tgl_lahir"
                                value="{{ old('tmpt_tgl_lahir') }}" placeholder="Tempat Lahir" required>
                            @error('tmpt_tgl_lahir')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-auto text-center mx-1">
                            <h3>/</h3>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <select name="tgl" class="form-select" required>
                                        <option value="">Tanggal</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}" {{ old('tgl') == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('tgl')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <select name="bln" class="form-select" required>
                                        <option value="">Bulan</option>
                                        @foreach ([1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'] as $key => $namaBln)
                                            <option value="{{ $key }}" {{ old('bln') == $key ? 'selected' : '' }}>
                                                {{ $namaBln }}</option>
                                        @endforeach
                                    </select>
                                    @error('bln')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-2">
                                    <select name="thn" class="form-select" required>
                                        <option value="">Tahun</option>
                                        @for ($i = date('Y'); $i >= 1950; $i--)
                                            <option value="{{ $i }}" {{ old('thn') == $i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('thn')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="jeniskelamin" class="form-label">Jenis Kelamin</label>
                    <div class="mx-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Laki-laki" value="L"
                                {{ old('jeniskelamin', 'L') == 'L' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Laki-laki">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jeniskelamin" id="Perempuan" value="P"
                                {{ old('jeniskelamin') == 'P' ? 'checked' : '' }}>
                            <label class="form-check-label" for="Perempuan">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="no_hp" class="form-label">No Handphone</label>
                    <input type="no_hp" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
                </div>

                <!-- Jurusan -->
                <div class="mb-3">
                    <label for="jurusan_id" class="form-label">Jurusan</label>
                    <select class="form-select" id="jurusan" name="jurusan_id">
                        <option value="" disabled selected>Pilih Jurusan</option>
                        @foreach ($jurusan as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->namajurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Program Studi -->
                <div class="mb-3">
                    <label for="prodi_id" class="form-label">Prodi</label>
                    <select class="form-select" id="prodi" name="prodi_id">
                        <option value="" disabled selected>Pilih Prodi</option>
                        {{-- @foreach ($prodi as $prodi)
                            <option value="{{ $prodi->id_prodi }}">{{ $prodi->namaprodi }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jabatan_id" class="form-label">Jabatan</label>
                    <select class="form-select" id="jabatan_id" name="jabatan_id" required>
                        <option value="" disabled selected>Pilih jabatan</option>
                        @foreach ($jabatan as $jabatan)
                            <option value="{{ $jabatan->id_jabatan }}"
                                {{ old('jabatan_id') == $jabatan->id_jabatan ? 'selected' : '' }}>
                                {{ $jabatan->namajabatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="jabatanfungsional_id" class="form-label">Jabatan Fungsional</label>
                    <select class="form-select" id="jabatanfungsional_id" name="jabatanfungsional_id" required>
                        <option value="" disabled selected>Pilih Jabatan Fungsional</option>
                        @foreach ($jabatanfungsional as $jabatanfungsional)
                            <option value="{{ $jabatanfungsional->id }}"
                                {{ old('jabatanfungsional_id') == $jabatanfungsional->id ? 'selected' : '' }}>
                                {{ $jabatanfungsional->jabatanfungsional }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto"
                        accept=".jpg, .jpeg, .png">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
