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
        <h4 class="mb-0">Halaman Edit Daftar Keluhan</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/keluhan">Keluhan</a>
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
                        <form method="post" action="/keluhan/patch">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="w-100 mb-1">
                                <label for="tanggal" class="form-label">Tanggal Keluhan</label>
                                <input type="date" class="form-control" id="tanggal"
                                       name="tanggal" value="{{ $data->tanggal }}">
                            </div>
                            <div class="form-group w-100">
                                <label for="pedagang">Pedagang</label>
                                <select class="select2" name="pedagang" id="pedagang" style="width: 100%;">
                                    <option value="">--Pilih Pedagang--</option>
                                    @foreach($pedagang as $v)
                                        <option value="{{ $v->id }}" {{ $data->pedagang_id == $v->id ? 'selected' : '' }}>{{ $v->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="w-100 mb-1">
                                <label for="deskripsi" class="form-label">Isi Keluhan</label>
                                <textarea rows="3" class="form-control" id="deskripsi" placeholder="Isi Keluhan"
                                          name="deskripsi">{{ $data->deskripsi }}</textarea>
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
            $('.select2').select2({
                width: 'resolve'
            });
        });
    </script>
@endsection
