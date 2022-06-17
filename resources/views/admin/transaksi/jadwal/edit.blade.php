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
        <h4 class="mb-0">Halaman Edit Jadwal Piket Pegawai</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="/jadwal">Jadwal Piket Pegawai</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-2">
        <div class="row justify-content-center">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="/jadwal/patch">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="w-100 mb-1">
                                        <label for="tanggal" class="form-label">Tanggal Jadwal</label>
                                        <input type="date" class="form-control" id="tanggal"
                                               name="tanggal" value="{{ $data->tanggal }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="w-100 mb-1">
                                        <label for="mulai" class="form-label">Jam Mulai</label>
                                        <input type="time" class="form-control" id="mulai"
                                               name="mulai" value="{{ $data->mulai }}">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="w-100 mb-1">
                                        <label for="selesai" class="form-label">Jam Selesai</label>
                                        <input type="time" class="form-control" id="selesai"
                                               name="selesai" value="{{ $data->selesai }}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="w-100 mr-3">
                                    <select class="select2" name="pegawai" id="pegawai" style="width: 100%;">
                                        <option value="">--Pilih Pegawai--</option>
                                        @foreach($pegawai as $v)
                                            <option value="{{ $v->id }}">{{ $v->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <a href="#" class="btn btn-primary" id="btn-append">
                                    <i class="fa fa-plus mr-2"></i>
                                    <span>Tambah</span>
                                </a>
                            </div>

                            <hr>
                            <table id="table-data" class="display w-100 table table-bordered">
                                <thead>
                                <tr>
                                    <th width="5%" class="text-center">#</th>
                                    <th>Nama</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <hr>
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
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var table;
        var id = '{{ $data->id }}';

        function reload() {
            table.ajax.reload();
        }

        function destroy(id) {
            AjaxPost('/jadwal/delete-jadwal', {id}, function () {
                reload();
            });
        }

        $(document).ready(function () {
            $('.select2').select2({
                width: 'resolve'
            });

            $('#btn-append').on('click', function (e) {
                e.preventDefault();
                AjaxPost('/jadwal/append/' + id, {
                    pegawai: $('#pegawai').val()
                }, function () {
                    reload();
                })
            });
            table = DataTableGenerator('#table-data', '/jadwal/data/' + id, [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'pegawai.nama'},
                {
                    data: null, render: function (data, type, row, meta) {
                        return '<a href="#" class="btn btn-danger btn-delete-jadwal" data-id="' + data['id'] + '"><i class="fa fa-trash"></i></a>';
                    }
                },
            ], [], function (d) {
            }, {
                dom: 'ltipr',
                "fnDrawCallback": function (oSettings) {
                    $('.btn-delete-jadwal').on('click', function (e) {
                        e.preventDefault();
                        let id = this.dataset.id;
                        AlertConfirm('Apakah anda yakin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                            destroy(id);
                        });
                    })
                }
            });
        });
    </script>
@endsection
