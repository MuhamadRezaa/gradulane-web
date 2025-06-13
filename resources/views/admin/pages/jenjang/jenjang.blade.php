@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Data Jenjang</h2>
        <div class="">
            <a href="/admin/jenjang/create" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Tambah</a>
        </div>

        <table id="example1" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenjang</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->namajenjang }}</td>
                        <td>
                            <a href="/admin/jenjang/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/admin/jenjang/{{ $item->id }}" method="post" class="d-inline delete-form">
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
