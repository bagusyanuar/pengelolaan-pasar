<?php


namespace App\Http\Controllers\Admin;


use App\Helper\CustomController;
use App\Models\Pedagang;
use App\Models\Pengajuan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengajuanController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = Pengajuan::all();
        return view('admin.transaksi.pengajuan.index')->with(['data' => $data]);
    }

    public function add_page()
    {
        return view('admin.transaksi.pengajuan.add');
    }

    public function create()
    {
        try {
            $data = [
                'tanggal' => $this->postField('tanggal'),
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat'),
                'status' => 'menunggu',
            ];
            Pengajuan::create($data);
            return redirect()->back()->with(['success' => 'Berhasil Menambahkan Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
        }
    }

    public function edit_page($id)
    {
        $data = Pengajuan::findOrFail($id);
        return view('admin.transaksi.pengajuan.edit')->with(['data' => $data]);
    }

    public function patch()
    {
        try {
            $id = $this->postField('id');
            $pengajuan = Pengajuan::find($id);
            $data = [
                'tanggal' => $this->postField('tanggal'),
                'nama' => $this->postField('nama'),
                'no_hp' => $this->postField('no_hp'),
                'alamat' => $this->postField('alamat'),
                'status' => $this->postField('status'),
            ];
            $pengajuan->update($data);
            return redirect('/pengajuan')->with(['success' => 'Berhasil Merubah Data...']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['failed' => 'Terjadi Kesalahan' . $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $id = $this->postField('id');
            Pengajuan::destroy($id);
            return $this->jsonResponse('success', 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('failed', 500);
        }
    }

    public function proses($id)
    {
        $data = Pengajuan::findOrFail($id);
        if ($this->request->method() === 'POST') {
            DB::beginTransaction();
            try {
                $status = $this->postField('status');
                if ($status === 'terima') {
                    $username = $this->postField('username');
                    $password = $this->postField('password');
                    if ($username === '' || $password === '') {
                        return redirect()->back()->with(['failed' => 'username dan password harus di isi']);
                    }
                    $user_data = [
                        'username' => $this->postField('username'),
                        'password' => Hash::make($this->postField('password')),
                        'role' => 'pedagang',
                    ];

                    $user = User::create($user_data);

                    $pedagang_data = [
                        'user_id' => $user->id,
                        'nama' => $data->nama,
                        'no_hp' => $data->no_hp,
                        'alamat' => $data->alamat,
                    ];
                    Pedagang::create($pedagang_data);

                }
                $data->update([
                    'status' => $status
                ]);
                DB::commit();
                return redirect('/pengajuan')->with(['success' => 'Berhasil Memproses Pengajuan...']);
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with(['failed' => 'Terjadi Kesalahan ' . $e->getMessage()]);
            }
        }
        return view('admin.transaksi.pengajuan.proses')->with(['data' => $data]);
    }

    public function laporan_pengajuan()
    {
        return view('admin.laporan.pengajuan.index');
    }

    public function laporan_pengajuan_data()
    {
        try {
            $tgl1 = $this->field('tgl1');
            $tgl2 = $this->field('tgl2');
            $data = Pengajuan::whereBetween('tanggal', [$tgl1, $tgl2])
                ->get();
            return $this->basicDataTables($data);
        } catch (\Exception $e) {
            return $this->basicDataTables([]);
        }
    }

    public function laporan_pengajuan_cetak()
    {
        $tgl1 = $this->field('tgl1');
        $tgl2 = $this->field('tgl2');
        $data = Pengajuan::whereBetween('tanggal', [$tgl1, $tgl2])
            ->get();
        return $this->convertToPdf('admin.laporan.pengajuan.cetak', ['data' => $data, 'tgl1' => $tgl1, 'tgl2' => $tgl2]);

    }
}
