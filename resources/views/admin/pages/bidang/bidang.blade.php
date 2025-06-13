@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Data Bidang Keahlian</h2>
        <div class="">
            <a href="/admin/bidang/create" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Create</a>
        </div>

        <table id="bidang" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bidang</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->namabidang }}</td>
                        <td>
                            <a href="/admin/bidang/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/admin/bidang/{{ $item->id }}" method="post" class="d-inline delete-form">
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
