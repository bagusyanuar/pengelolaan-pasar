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
        <h4 class="mb-0">Halaman Daftar Sarana</h4>
        <ol class="breadcrumb breadcrumb-transparent mb-0">
            <li class="breadcrumb-item">
                <a href="/">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Sarana
            </li>
        </ol>
    </div>
    <div class="w-100 p-2">
        <div class="text-right mb-2 pr-3">
            <a href="/sarana/tambah" class="btn btn-primary"><i class="fa fa-plus mr-1"></i><span
                    class="font-weight-bold">Tambah</span></a>
        </div>
        <table id="table-data" class="display w-100 table table-bordered">
            <thead>
            <tr>
                <th width="5%" class="text-center">#</th>
                <th>Nama</th>
                <th>Qty</th>
                <th width="10%" class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $v)
                <tr>
                    <td width="5%" class="text-center">{{ $loop->index + 1 }}</td>
                    <td>{{ $v->nama }}</td>
                    <td>{{ $v->qty }}</td>
                    <td class="text-center">
                        <a href="/sarana/edit/{{ $v->id }}" class="btn btn-sm btn-warning btn-edit"
                           data-id="{{ $v->id }}"><i class="fa fa-edit"></i></a>
                        <a href="#" class="btn btn-sm btn-danger btn-delete" data-id="{{ $v->id }}"><i
                                class="fa fa-trash"></i></a>
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
            AjaxPost('/sarana/delete', {id}, function () {
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
