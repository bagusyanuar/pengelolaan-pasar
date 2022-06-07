@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Keluhan Pedagang</div>
    <div class="text-center">Dari Tanggal {{ $tgl1 }} sampai dengan {{ $tgl2 }}</div>
    <hr>
    <table id="my-table" class="table display">
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
        @foreach($data as $v)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->tanggal }}</td>
                <td>{{ $v->pedagang->nama }}</td>
                <td>{{ $v->deskripsi }}</td>
                <td class="text-center">{{ $v->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
