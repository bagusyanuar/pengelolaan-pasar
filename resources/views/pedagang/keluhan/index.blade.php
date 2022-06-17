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
        <h4 class="mb-0">Halaman Daftar Keluhan Saya</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Keluhan Saya
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="text-right mb-2 pr-3">
            <a href="/keluhan-saya/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                    class="font-weight-bold">Tambah</span></a>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th width="15%">Tanggal</th>
                <th>Deskripsi</th>
                <th width="15%">Status</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->tanggal }}</td>
                    <td>{{ $v->deskripsi }}</td>
                    <td>
                        @php
                            $status_color = 'primary-pills';

                            if($v->status === 'proses') {
                                $status_color = 'warning-pills';
                            } else if ($v->status === 'selesai') {
                                $status_color = 'success-pills';
                            }
                        @endphp
                        <span class="{{ $status_color }}">{{ $v->status }}</span>
                    </td>
                    <td class="text-center">
                        @if($v->status == 'menunggu')
                            <a href="/keluhan-saya/edit/{{ $v->id }}" class="btn btn-sm btn-warning btn-edit"
                               data-id="{{ $v->id }}"><i class="fa fa-edit"></i></a>
                            <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                    class="fa fa-trash"></i></a>
                        @else
                            <span>-</span>
                        @endif
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
            AjaxPost('/keluhan-saya/delete', {id}, function () {
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
