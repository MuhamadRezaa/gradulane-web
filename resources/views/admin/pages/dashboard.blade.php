@extends('admin.layouts.template')

@section('main')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
    </div>

    <div class="card m-1 p-4">
        <h4 class="my-3">Selamat Datang, {{ Auth::user()->namalengkap }}</h4>
    </div>
@endsection
