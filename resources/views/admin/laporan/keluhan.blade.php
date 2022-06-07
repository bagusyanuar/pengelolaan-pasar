@extends('admin.layout')

@section('css')
@endsection

@section('content')
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire("Berhasil!", '{{\Illuminate\Support\Facades\Session::get('success')}}', "success")
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Halaman Laporan Keluhan</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Keluhan
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-3">
        <div class="d-flex justify-content-start align-items-center mb-3">
            <div class="mr-2"><span>Tanggal : </span></div>
            <div class="mb-1">
                <input type="date" class="form-control form-control-sm" id="tgl1"
                       name="tgl1" value="{{ date('Y-m-d') }}">
            </div>
            <div class="mr-1 ml-1"><span class="font-weight-bold">S/D</span></div>
            <div class="mb-1">
                <input type="date" class="form-control form-control-sm" id="tgl2"
                       name="tgl2" value="{{ date('Y-m-d') }}">
            </div>
        </div>

        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Tanggal</th>
                <th width="15%">Nama Pedagang</th>
                <th>Deskripsi</th>
                <th width="15%">Status</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="text-right mt-2 pr-3">
            <a href="#" class="btn btn-primary" id="btn-cetak"><i class="fa fa-print mr-1"></i><span
                    class="font-weight-bold">Cetak</span></a>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        var table;
        function reload() {
            table.ajax.reload();
        }
        $(document).ready(function () {
            table = DataTableGenerator('#table-data', '/laporan-keluhan/data', [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                {data: 'tanggal'},
                {data: 'pedagang.nama'},
                {data: 'deskripsi'},
                {data: 'status'},
            ], [], function(d){
                d.tgl1 = $('#tgl1').val();
                d.tgl2 = $('#tgl2').val();
            }, {
                dom: 'ltipr'
            });

            $('#tgl1').on('change', function (e) {
                reload();
            });
            $('#tgl2').on('change', function (e) {
                reload();
            });

            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                let tgl1 = $('#tgl1').val();
                let tgl2 = $('#tgl2').val();
                window.open('/laporan-keluhan/cetak?tgl1=' + tgl1 + '&tgl2=' + tgl2, '_blank');
            })
        });
    </script>
@endsection
