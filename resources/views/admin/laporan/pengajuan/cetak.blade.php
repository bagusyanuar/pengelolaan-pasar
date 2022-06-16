@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Pengajuan Ijin Pedagang</div>
    <div class="text-center">Dari Tanggal {{ $tgl1 }} sampai dengan {{ $tgl2 }}</div>
    <hr>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th width="15%">Tanggal</th>
            <th>Nama</th>
            <th>No. Hp</th>
            <th>Alamat</th>
            <th width="15%">Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->tanggal }}</td>
                <td>{{ $v->nama }}</td>
                <td>{{ $v->no_hp }}</td>
                <td>{{ $v->alamat }}</td>
                <td class="text-center">{{ $v->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
