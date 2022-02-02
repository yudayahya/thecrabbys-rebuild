<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManageAdmin extends Controller
{
    public function index()
    {
        return view('admin.manage_admin.index');
    }

    public function get_data()
    {
        $admins = Admin::where('level', 'admin')->latest()->get();
        $data = array();
        $no = 1;
        foreach ($admins as $admin) {
            $row = array();
            $row[] = $no;
            $row[] = $admin->name;
            $row[] = $admin->username;
            $row[] = $admin->email;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah Password" onclick="ubah_data(' . "'" . $admin->id . "'" . ',' . "'" . $admin->name . "'" . ')"><i class="far fa-edit"></i> Ubah Password</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data(' . "'" . $admin->id . "'" . ')"><i class="fas fa-trash-alt"></i> Hapus</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        return response()->json($output);
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required',
            'username' => 'required|alpha_num|unique:admins,username',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8|confirmed',
        ];

        $customMessages = [
            'required' => 'Mohon isi :attribute!',
            'alpha_num' => 'Hanya huruf dan angka tanpa spasi yang diperbolehkan!',
            'unique' => ':attribute sudah digunakan!',
            'email' => 'Format email salah!',
            'min' => 'Minimal 8 karakter!',
            'confirmed' => 'Password yang anda ulang tidak cocok!',
        ];

        $this->validate($request, $rules, $customMessages);

        $admin = new Admin;
        $admin->name = $request->nama;
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return response()->json(['success' => 'Data Admin Berhasil Ditambah!']);
    }

    public function update(Request $request)
    {
        $admin = new Admin;
        $data = $admin->find($request->id);
        if ($data) {
            $rules = [
                'cek_password' => 'required|current_password:admin',
                'newpassword' => 'required|min:8|confirmed',
            ];

            $customMessages = [
                'required' => 'Data Tidak Boleh Kosong!',
                'current_password' => 'Password Kamu Tidak Sesuai!',
                'min' => 'Minimal 8 karakter!',
                'confirmed' => 'Password yang anda ulang tidak cocok!',
            ];

            $this->validate($request, $rules, $customMessages);

            $data->password = bcrypt($request->newpassword);
            $data->save();

            return response()->json(['success' => 'Password Admin Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Admin Invalid!']);
        }
    }

    public function destroy(Request $request)
    {
        Admin::find($request->id)->delete();

        return response()->json(['success' => 'Data Admin Berhasil Dihapus!']);
    }
}
