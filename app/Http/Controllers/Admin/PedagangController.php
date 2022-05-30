<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Member;
use App\Models\Pedagang;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PedagangController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pedagang::all();
        return view('admin.master.pedagang.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.master.pedagang.add');
    }

    public function create()
    {
        try {
            $member_data = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat')
            ];
            Pedagang::create($member_data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Pedagang::findOrFail($id);
        return view('admin.master.pedagang.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $pedagang = Pedagang::find($id);
            $member_data = [
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat')
            ];
            $pedagang->update($member_data);
            return redirect('/pedagang')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Pedagang::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }
}
