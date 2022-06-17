<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pedagang;
use App\Models\Pegawai;

class PegawaiController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pegawai::all();
        return view('admin.master.pegawai.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.master.pegawai.add');
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat')
            ];
            Pegawai::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Pegawai::findOrFail($id);
        return view('admin.master.pegawai.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $pedagang = Pegawai::find($id);
            $member_data = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat')
            ];
            $pedagang->update($member_data);
            return redirect('/pegawai')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Pegawai::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
