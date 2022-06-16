@extends('admin.layout')

@section('css')
    <link href="{{ asset('/adminlte/plugins/select2/select2.css') }}" rel="stylesheet">
    <style>
        .select2-selection {
            height: 40px !important;
            line-height: 40px !important;
        }
    </style>
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif

    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Halaman Edit Pengajuan Ijin Berdagang</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/pengajuan">Pengajuan Ijin Berdagang</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/pengajuan/patch">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="w-100 mb-1">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal"
                                       name="tanggal" value="{{ $data->tanggal }}">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap"
                                       name="nama" value="{{ $data->nama }}">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="no_hp" class="form-label">No. Hp</label>
                                <input type="number" class="form-control" id="no_hp" placeholder="No. Hp"
                                       name="no_hp" value="{{ $data->no_hp }}">
                            </div>
                            <div class="w-100 mb-1">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea rows="3" class="form-control" id="alamat" placeholder="Alamat"
                                          name="alamat">{{ $data->alamat }}</textarea>
                            </div>
                            <div class="w-100 mb-2 mt-3 text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/adminlte/plugins/select2/select2.js') }}"></script>
    <script src="{{ asset('/adminlte/plugins/select2/select2.full.js') }}"></script>
    <script>
        $(document).ready(function () {
        });
    </script>
@endsection
