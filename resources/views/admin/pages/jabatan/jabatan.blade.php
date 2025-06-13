@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Data jabatan</h2>
        <div class="">
            <a href="/admin/jabatan/create" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Tambah</a>
        </div>

        <table id="example1" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>jabatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->namajabatan }}</td>
                        <td>
                            <a href="/admin/jabatan/{{ $item->id_jabatan }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/admin/jabatan/{{ $item->id_jabatan }}" method="post"
                                class="d-inline delete-form">
                                @method('delete')
                                @csrf
                                <button type="button" class="btn btn-danger delete-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
