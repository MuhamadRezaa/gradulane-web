@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Daftar Bidang Dosen</h2>
        <a href="{{ route('bidangdosen.create') }}" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">
            Tambah Bidang Dosen
        </a>

        <table id="bidangdosen" class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Dosen</th>
                    <th>Bidang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosens as $dosen)
                    <tr>
                        <td>{{ $dosen->namadosen }}</td>
                        <td>
                            @if ($dosen->bidangs->isEmpty())
                                <span class="text-muted">Belum ada bidang</span>
                            @else
                                @foreach ($dosen->bidangs as $bidang)
                                    {{ $bidang->namabidang }}{{ !$loop->last ? ',' : '' }}
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('bidangdosen.edit', $dosen->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('bidangdosen.destroy', $dosen->id) }}" method="POST"
                                class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger delete-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
