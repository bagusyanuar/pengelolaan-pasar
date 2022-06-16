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
        <h4 class="mb-0">Halaman Pengajuan Ijin Berdagang</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Pengajuan Ijin Berdagang
            </li>
        </ol>
    </div>
    <div class="w-100 p-2 mt-3">
        <div class="text-right mb-2 pr-3">
            <a href="/pengajuan/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                    class="font-weight-bold">Tambah</span></a>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Tanggal</th>
                <th>Nama</th>
                <th>No. Hp</th>
                <th>Alamat</th>
                <th>Status</th>
                <th width="15%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->tanggal }}</td>
                    <td>{{ $v->nama }}</td>
                    <td>{{ $v->no_hp }}</td>
                    <td>{{ $v->alamat }}</td>
                    <td>
                        @php
                            $status_color = 'warning-pills';
                            if($v->status === 'tolak') {
                                $status_color = 'danger-pills';
                            } else if ($v->status === 'terima') {
                                $status_color = 'success-pills';
                            }
                        @endphp
                        <span class="{{ $status_color }}">{{ $v->status }}</span>
                    </td>
                    <td class="text-center">
                        <a href="/pengajuan/edit/{{ $v->id }}" class="btn btn-sm btn-warning btn-edit"
                           data-id="{{ $v->id }}"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                class="fa fa-trash"></i></a>
                        <a href="/pengajuan/proses/{{ $v->id }}" class="btn btn-sm btn-success btn-edit"
                           data-id="{{ $v->id }}"><i class="fa fa-check"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script type="text/javascript">
        function destroy(id) {
            AjaxPost('/pengajuan/delete', {id}, function () {
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
        });
    </script>
@endsection
