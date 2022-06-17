<?php


namespace App\Http\Controllers\Pedagang;


use App\Helper\CustomController;
use App\Models\Keluhan;
use App\Models\Pedagang;

class KeluhanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $pedagang_id = auth()->user()->pedagang->id;
        $data = Keluhan::with('pedagang')->where('pedagang_id', '=', $pedagang_id)->get();
        return view('pedagang.keluhan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('pedagang.keluhan.add');
    }

    public function create()
    {
        try {
            $pedagang_id = auth()->user()->pedagang->id;
            $data = [
                'pedagang_id' => $pedagang_id,
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
        $pedagang_id = auth()->user()->pedagang->id;
        $data = Keluhan::with('pedagang')->where('pedagang_id', '=', $pedagang_id)->findOrFail($id);
        return view('pedagang.keluhan.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $keluhan = Keluhan::find($id);
            $data = [
                'deskripsi' => $this->postField('deskripsi'),
                'tanggal' => $this->postField('tanggal'),
            ];
            $keluhan->update($data);
            return redirect('/keluhan-saya')->with(['success' => 'Berhasil Merubah Data...']);
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
}
