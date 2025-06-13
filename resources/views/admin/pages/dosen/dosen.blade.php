@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Data Dosen</h2>
        <div>
            <a href="/admin/dosen/create" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Create</a>
        </div>

        <table id="TabelDosen" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                    <th>NIDN</th>
                    <th>NIP</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->namadosen }}</td>
                        <td>{{ $item->nidn }}</td>
                        <td>{{ $item->nip }}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="/admin/dosen/detail/{{ $item->id }}" class="btn btn-primary">
                                    <i class="fas fa-info-circle"></i> Detail
                                </a>
                                <form action="/admin/dosen/{{ $item->id }}" method="post" class="d-inline delete-form">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger delete-btn"><i
                                            class="fas fa-trash-alt"></i> Remove</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
