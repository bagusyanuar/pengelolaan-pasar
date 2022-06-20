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
        <h4 class="mb-0">Halaman Detail Jadwal Piket Pegawai</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Detail Jadwal Piket Pegawai
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-3">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="font-weight-bold">Detail Jadwal</p>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Tanggal</span>
                            <span class="w-50  font-weight-bold">: {{ $data->tanggal }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Jam Mulai</span>
                            <span class="w-50  font-weight-bold">: {{ $data->mulai }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <span class="w-50 font-weight-bold">Jam Selesai</span>
                            <span class="w-50  font-weight-bold">: {{ $data->selesai }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Nama Pegawai</th>
                <th width="15%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->jadwal_pegawai as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->pegawai->nama }}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-right mt-3">
            <a href="#" class="btn btn-success" id="btn-cetak">
                <i class="fa fa-print mr-2"></i>
                <span>Cetak</span>
            </a>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        var id = '{{ $data->id }}';

        function destroy(id) {
            AjaxPost('/jadwal/delete-jadwal', {id}, function () {
                window.location.reload();
            });
        }

        $(document).ready(function () {
            $('#table-data').DataTable();
            $('.btn-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Apakah anda yakin menghapus?', 'Data yang dihapus tidak dapat dikembalikan!', function () {
                    destroy(id);
                })
            });

            $('#btn-cetak').on('click', function (e) {
                e.preventDefault();
                window.open('/jadwal/detail/' + id + '/cetak', '_blank');
            })
        });
    </script>
@endsection
