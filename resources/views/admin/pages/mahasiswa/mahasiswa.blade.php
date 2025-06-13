@extends('admin.layouts.template')

@section('main')
    <div class="card m-3 p-4 shadow-sm">
        <h2 class="mb-4">Data Mahasiswa</h2>
        <div>
            <a href="/admin/mahasiswa/create" class="btn btn-primary my-3 col-auto">
                <i class="fas fa-plus"></i> Create
            </a>
        </div>

        <table id="TabelMahasiswa" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->namamhs }}</td>
                        <td>{{ $item->nim }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="/admin/mahasiswa/detail/{{ $item->id }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                                <form action="/admin/mahasiswa/{{ $item->id }}" method="post"
                                    class="d-inline delete-form">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger delete-btn">
                                        <i class="fas fa-trash-alt"></i> Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
