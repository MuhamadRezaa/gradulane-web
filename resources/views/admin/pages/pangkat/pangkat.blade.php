@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Data Pangkat</h2>
        <div class="">
            <a href="/admin/pangkat/create" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Tambah</a>
        </div>

        <table id="example1" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pangkat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->namapangkat }}</td>
                        <td>
                            <a href="/admin/pangkat/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/admin/pangkat/{{ $item->id }}" method="post" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger" onclick="return confirm('Yakin?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
