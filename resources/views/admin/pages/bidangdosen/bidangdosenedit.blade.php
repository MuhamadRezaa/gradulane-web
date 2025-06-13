@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Edit Bidang Dosen</h2>
        <a href="{{ route('bidangdosen.index') }}" class="btn btn-primary my-3 col-1 d-inline-block">Kembali</a>

        <form action="{{ route('bidangdosen.update', $dosen->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="width-75">
                <div class="mb-3">
                    <label for="dosen_id" class="form-label">Nama Dosen</label>
                    <input type="text" value="{{ $dosen->namadosen }}" readonly class="form-control">
                </div>

                <div class="mb-3">
                    <label for="bidang_id" class="form-label">Bidang</label>
                    <div id="bidang_id" class="d-flex flex-wrap gap-2">
                        @foreach ($bidangs as $bidang)
                            <input type="checkbox" class="btn-check" id="bidang{{ $bidang->id }}" name="bidang_id[]"
                                value="{{ $bidang->id }}" {{ in_array($bidang->id, $selectedBidangIds) ? 'checked' : '' }}
                                autocomplete="off">
                            <label class="btn btn-outline-primary"
                                for="bidang{{ $bidang->id }}">{{ $bidang->namabidang }}</label>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </form>
    </div>
@endsection
