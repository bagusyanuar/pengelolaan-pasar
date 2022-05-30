<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kios;
use App\Models\Member;
use App\Models\Pedagang;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KiosController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Kios::with('pedagang')->get();
        return view('admin.master.kios.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $data = Pedagang::all();
        return view('admin.master.kios.add')->with(['data' => $data]);
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'pedagang_id' => $this->postField('pedagang') === '' ?  null : $this->postField('pedagang'),
            ];
            Kios::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Kios::findOrFail($id);
        $pedagang = Pedagang::all();
        return view('admin.master.kios.edit')->with(['data' => $data, 'pedagang' => $pedagang]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $kios = Kios::find($id);
            $data = [
                'nama' => $this->postField('nama'),
                'pedagang_id' => $this->postField('pedagang') === '' ?  null : $this->postField('pedagang'),
            ];
            $kios->update($data);
            return redirect('/kios')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            DB::beginTransaction();
            $id = $this->postField('id');
            $kios = Kios::find($id);
            $kios->update([
                'pedagang_id' => null
            ]);
            $kios->delete();
            DB::commit();
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonResponse('failed', 500);
        }
    }
}
