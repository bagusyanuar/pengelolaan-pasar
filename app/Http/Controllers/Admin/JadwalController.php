<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Jadwal;
use App\Models\JadwalPegawai;
use App\Models\Keluhan;
use App\Models\Pedagang;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;

class JadwalController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Jadwal::all();
        return view('admin.transaksi.jadwal.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $data = Pedagang::all();
        $pegawai = Pegawai::all();
        return view('admin.transaksi.jadwal.add')->with(['data' => $data, 'pegawai' => $pegawai]);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $data = [
                'tanggal' => $this->postField('tanggal'),
                'mulai' => $this->postField('mulai'),
                'selesai' => $this->postField('selesai'),
            ];
            $jadwal = Jadwal::create($data);
            $pegawai = JadwalPegawai::with('pegawai')->whereNull('jadwal_id')->get();
            if (count($pegawai) <= 0) {
                return redirect()->back()->with(['failed' => 'Tidak Ada Daftar Pegawai....']);
            }
            foreach ($pegawai as $v) {
                $v->update([
                    'jadwal_id' => $jadwal->id
                ]);
            }
            DB::commit();
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Jadwal::with(['jadwal_pegawai.pegawai'])->findOrFail($id);
        $pegawai = Pegawai::all();
        return view('admin.transaksi.jadwal.edit')->with(['data' => $data, 'pegawai' => $pegawai]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $jadwal = Jadwal::find($id);
            $data = [
                'tanggal' => $this->postField('tanggal'),
                'mulai' => $this->postField('mulai'),
                'selesai' => $this->postField('selesai'),
            ];
            $jadwal->update($data);
            return redirect('/jadwal')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            DB::beginTransaction();
            JadwalPegawai::with('jadwal')->where('jadwal_id', '=', $id)->delete();
            Jadwal::destroy($id);
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('failed', 500);
        }
    }

    public function append_jadwal_pegawai()
    {
        try {
            JadwalPegawai::create([
                'jadwal_id' => null,
                'pegawai_id' => $this->postField('pegawai')
            ]);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function data_jadwal_pegawai()
    {
        try {
            $data = JadwalPegawai::with(['pegawai'])->whereNull('jadwal_id')->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function delete_data_jadwal_pegawai()
    {
        try {
            $id = $this->postField('id');
            JadwalPegawai::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }

    public function append_jadwal_pegawai_detail($id)
    {
        try {
            JadwalPegawai::create([
                'jadwal_id' => $id,
                'pegawai_id' => $this->postField('pegawai')
            ]);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed ' . $e->getMessage(), 500);
        }
    }

    public function data_jadwal_pegawai_detail($id)
    {
        try {
            $data = JadwalPegawai::with(['pegawai'])->where('jadwal_id', '=', $id)->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function jadwal_detail_page($id)
    {
        $data = Jadwal::with('jadwal_pegawai.pegawai')->where('id', '=', $id)->firstOrFail();
        return view('admin.transaksi.jadwal.detail')->with(['data' => $data]);
    }

    public function jadwal_detail_cetak($id)
    {
        $data = Jadwal::with('jadwal_pegawai.pegawai')->where('id', '=', $id)->firstOrFail();
        return $this->convertToPdf('admin.laporan.jadwal.cetak', ['data' => $data]);
    }
}
