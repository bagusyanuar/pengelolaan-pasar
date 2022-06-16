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
        <h4 class="mb-0">Halaman Proses Pengajuan Ijin Berdagang</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/pengajuan">Pengajuan Ijin Berdagang</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Proses
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6 col-sm-11">
                <div class="card">
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="form-group w-100">
                                <label for="status">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="terima">Terima</option>
                                    <option value="tolak">Tolak</option>
                                </select>
                            </div>
                            <div class="d-block" id="panel-user">
                                <div class="w-100 mb-1">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" placeholder="Username"
                                           name="username">
                                </div>
                                <div class="w-100 mb-1">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password"
                                           name="password">
                                </div>
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
            $('#status').on('change', function () {
                let value = this.value;
                if (value === 'tolak') {
                    $('#panel-user').removeClass('d-block');
                    $('#panel-user').addClass('d-none');
                } else {
                    $('#panel-user').addClass('d-block');
                    $('#panel-user').removeClass('d-none');
                }
                console.log(this.value);
            })
        });
    </script>
@endsection
