@extends('admin.layouts.template')

@section('main')
    <div class="card m-1 p-4">
        <h2>Data User</h2>
        <div class="">
            <a href="/admin/user/create" class="btn btn-primary my-3 col-1 d-inline-block" style="width:auto">Create</a>
        </div>

        <table id="TabelUser" class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>
                            @if ($item->foto == '-')
                                <img src="{{ asset('storage/images/defaultfoto.png') }}?{{ time() }}"
                                    alt="Foto Mahasiswa" class="img-fluid rounded" style="max-width: 100px; height: auto;">
                            @else
                                <img src="{{ asset('storage/' . $item->foto) }}?{{ time() }}" alt="Foto Mahasiswa"
                                    class="img-fluid rounded" style="max-width: 100px; height: auto;">
                            @endif
                        </td>
                        <td>{{ $item->namalengkap }}</td>
                        <td>
                            @if ($item->nim == '')
                                <span>-</span>
                            @else
                                {{ $item->nim }}
                            @endif
                        </td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->level }}</td>
                        <td>
                            <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-warning">Edit</a>
                            <form action="/admin/user/{{ $item->id }}" method="post" class="d-inline delete-form">
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
