<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Kios;
use App\Models\Pedagang;
use App\Models\Sarana;
use Illuminate\Support\Facades\DB;

class SaranaController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Sarana::all();
        return view('admin.master.sarana.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        $data = Pedagang::all();
        return view('admin.master.sarana.add')->with(['data' => $data]);
    }

    public function create()
    {
        try {
            $data = [
                'nama' => $this->postField('nama'),
                'qty' => $this->postField('qty'),
            ];
            Sarana::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Sarana::findOrFail($id);
        return view('admin.master.sarana.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $sarana = Sarana::find($id);
            $data = [
                'nama' => $this->postField('nama'),
                'qty' => $this->postField('qty'),
            ];
            $sarana->update($data);
            return redirect('/sarana')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Sarana::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
