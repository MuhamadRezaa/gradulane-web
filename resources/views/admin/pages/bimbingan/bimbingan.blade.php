@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2 class="my-3">Data Bimbingan</h2>
        @if (Gate::allows('isMahasiswa'))
            <table id="bimbingan" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Pembimbing 1</th>
                        <th>Pembimbing 2</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->mahasiswa->namamhs }}</td>
                            <td>{{ $item->pembimbingta1->namadosen }}</td>
                            <td>{{ $item->pembimbingta2->namadosen }}</td>
                            <td>
                                <a href="/admin/bimbingan/detail/{{ $item->id }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif (Gate::allows('isDosen'))
            <table id="bimbingan" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->mahasiswa->namamhs }}</td>
                            <td>
                                <a href="/admin/bimbingan/detail/{{ $item->id }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif (Gate::allows('isKaprodi'))
            <table id="bimbingan" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mahasiswa</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->mahasiswa->namamhs }}</td>
                            <td>
                                <a href="/admin/bimbingan/detail/{{ $item->id }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
