<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Keluhan;
use App\Models\Pedagang;
use App\Models\Sarana;
use Carbon\Carbon;

class KeluhanController extends CustomController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Keluhan::with('pedagang')->get();
        return view('admin.master.keluhan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $data = Pedagang::all();
        return view('admin.master.keluhan.add')->with(['data' => $data]);
    }

    public function create()
    {
        try {
            $data = [
                'pedagang_id' => $this->postField('pedagang'),
                'deskripsi' => $this->postField('deskripsi'),
                'tanggal' => $this->postField('tanggal'),
                'status' => 'menunggu',
            ];
            Keluhan::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Keluhan::with('pedagang')->findOrFail($id);
        $pedagang = Pedagang::all();
        return view('admin.master.keluhan.edit')->with(['data' => $data, 'pedagang' => $pedagang]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $keluhan = Keluhan::find($id);
            $data = [
                'pedagang_id' => $this->postField('pedagang'),
                'deskripsi' => $this->postField('deskripsi'),
                'tanggal' => $this->postField('tanggal'),
                'status' => $this->postField('status'),
            ];
            $keluhan->update($data);
            return redirect('/keluhan')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Keluhan::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }

    public function laporan_page()
    {
        return view('admin.laporan.keluhan');
    }

    public function get_data_laporan_keluhan()
    {
        try {
            $tgl1 = $this->field('tgl1') ?? Carbon::now();
            $tgl2 = $this->field('tgl2') ?? Carbon::now();
            $data = Keluhan::with('pedagang')
                ->whereBetween('tanggal', [$tgl1, $tgl2])
                ->get();
            return $this->basicDataTables($data);
        }catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }
    public function cetak_laporan_keluhan()
    {
        $tgl1 = $this->field('tgl1') ?? Carbon::now();
        $tgl2 = $this->field('tgl2') ?? Carbon::now();
        $data = Keluhan::with('pedagang')
            ->whereBetween('tanggal', [$tgl1, $tgl2])
            ->get();
        return $this->convertToPdf('cetak.keluhan', [
            'data' => $data,
            'tgl1' => $tgl1,
            'tgl2' => $tgl2,
        ]);
    }
}
