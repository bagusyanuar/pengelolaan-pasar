@extends('cetak.index')

@section('content')
    <div class="text-center f-bold report-title">Laporan Jadwal Piket Pegawai {{ $data->tanggal }}</div>
    <hr>
    <table id="my-table" class="table display">
        <thead>
        <tr>
            <th width="5%" class="text-center">#</th>
            <th>Nama Pegawai</th>
            <th>Mulai</th>
            <th>Selesai</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data->jadwal_pegawai as $v)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $v->pegawai->nama }}</td>
                <td>{{ $data->mulai }}</td>
                <td>{{ $data->selesai }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
