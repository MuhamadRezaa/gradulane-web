@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2 class="my-3">Form Jadwal Sidang</h2>
        <form method="post" action="/sitajadwal/{{ $sita->id }}" enctype="multipart/form-data">
            @csrf
            <div class="width-75">
                <!-- Ketua Sidang -->
                <div class="mb-3">
                    <label for="ketuasidang_id" class="form-label">Ketua Sidang</label>
                    <select name="ketuasidang_id" id="ketuasidang_id"
                        class="form-select @error('ketuasidang_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih</option>

                        @if ($pembimbing1ta)
                            <option value="{{ $pembimbing1ta }}" @if (old('ketuasidang_id') == $pembimbing1ta) selected @endif>
                                {{ \App\Models\Dosen::find($pembimbing1ta)->namadosen }}
                            </option>
                        @endif

                        @if ($pembimbing2ta)
                            <option value="{{ $pembimbing2ta }}" @if (old('ketuasidang_id') == $pembimbing2ta) selected @endif>
                                {{ \App\Models\Dosen::find($pembimbing2ta)->namadosen }}
                            </option>
                        @endif
                    </select>

                    @error('ketuasidang_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <!-- Sekretaris Sidang -->
                <div class="mb-3">
                    <label for="sekretaris_id" class="form-label">Sekretaris Sidang</label>
                    <br>
                    <select name="sekretaris_id" id="sekretaris_id"
                        class="form-select @error('sekretaris_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih</option>
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}" @if (old('sekretaris_id') == $item->id) selected @endif>
                                {{ $item->namadosen }}</option>
                        @endforeach
                    </select>
                    @error('sekretaris_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penguji Satu -->
                <div class="mb-3">
                    <label for="penguji1_id" class="form-label">Penguji Satu</label>
                    <br>
                    <select name="penguji1_id" id="penguji1_id"
                        class="form-select @error('penguji1_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih</option>
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}" @if (old('penguji1_id') == $item->id) selected @endif>
                                {{ $item->namadosen }}</option>
                        @endforeach
                    </select>
                    @error('penguji1_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Penguji Dua -->
                <div class="mb-3">
                    <label for="penguji2_id" class="form-label">Penguji Dua</label>
                    <br>
                    <select name="penguji2_id" id="penguji2_id"
                        class="form-select @error('penguji2_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih</option>
                        @foreach ($dosen as $item)
                            <option value="{{ $item->id }}" @if (old('penguji2_id') == $item->id) selected @endif>
                                {{ $item->namadosen }}</option>
                        @endforeach
                    </select>
                    @error('penguji2_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tanggal dan Waktu -->
                <div class="mb-3">
                    <label for="tgl_sita" class="form-label">Tanggal & Waktu Seminar Proposal</label>
                    <div class="row">
                        <div class="col-md-6"><input type="date"
                                class="form-control @error('tgl_sita') is-invalid @enderror" id="tgl_sita" name="tgl_sita"
                                required>
                            @error('tgl_sita')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <select class="form-select" id="sesi_id" name="sesi_id" required>
                                <option value="">-- Pilih Sesi --</option>
                                @foreach ($sesi as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->namasesi }} : {{ date('H:i', strtotime($item->waktumulai)) }}
                                        - {{ date('H:i', strtotime($item->waktuakhir)) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sesi_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>

                <!-- Ruangan -->
                <div class="mb-3">
                    <label for="ruangan_id" class="form-label">Ruangan</label>
                    <br>
                    <select name="ruangan_id" class="form-select @error('ruangan_id') is-invalid @enderror" required>
                        <option value="" disabled selected>Pilih</option>
                        @foreach ($ruangan as $item)
                            <option value="{{ $item->id }}" @if (old('ruangan_id') == $item->id) selected @endif>
                                {{ $item->koderuangan }}-{{ $item->namaruangan }}</option>
                        @endforeach
                    </select>
                    @error('ruangan_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- JavaScript untuk Mencegah Pilihan Sama -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sekretaris = document.getElementById('sekretaris_id');
            const penguji1 = document.getElementById('penguji1_id');
            const penguji2 = document.getElementById('penguji2_id');

            const dropdowns = [sekretaris, penguji1, penguji2]; // Gabungkan semua dropdown

            const updateDropdowns = () => {
                // Ambil nilai yang dipilih dari semua dropdown
                const selectedValues = dropdowns.map(dropdown => dropdown.value).filter(value => value !== "");

                dropdowns.forEach(currentDropdown => {
                    const currentValue = currentDropdown.value; // Nilai dropdown saat ini

                    // Iterasi semua opsi dalam dropdown
                    Array.from(currentDropdown.options).forEach(option => {
                        if (option.value === "") {
                            option.style.display = "block"; // Pilihan default selalu terlihat
                        } else if (selectedValues.includes(option.value) && option.value !==
                            currentValue) {
                            option.style.display =
                                "none"; // Sembunyikan opsi yang sudah dipilih di dropdown lain
                        } else {
                            option.style.display = "block"; // Tampilkan opsi yang belum dipilih
                        }
                    });
                });
            };

            // Tambahkan event listener untuk setiap dropdown
            dropdowns.forEach(dropdown => {
                dropdown.addEventListener('change', updateDropdowns);
            });

            // Jalankan pembaruan awal
            updateDropdowns();
        });
    </script>
@endsection
