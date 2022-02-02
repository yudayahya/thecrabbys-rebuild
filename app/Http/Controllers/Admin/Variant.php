<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Variant as ModelsVariant;
use Illuminate\Http\Request;

class Variant extends Controller
{
    public function index()
    {
        return view('admin.variant.index');
    }

    public function get_data()
    {
        $variants = ModelsVariant::latest()->get();
        $data = array();
        $no = 1;
        foreach ($variants as $variant) {
            $row = array();
            $row[] = $no;
            $row[] = $variant->name;
            $row[] = $variant->price;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="ubah_data(' . "'" . $variant->id . "'" . ',' . "'" . $variant->name . "'" . ',' . "'" . $variant->price . "'" . ')"><i class="far fa-edit"></i> Ubah</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data(' . "'" . $variant->id . "'" . ')"><i class="fas fa-trash-alt"></i> Hapus</a>';

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
            'harga' => 'required|numeric',
        ];

        $customMessages = [
            'required' => 'Mohon isi :attribute varian saos!',
            'numeric' => 'Hanya angka yang diperbolekan!',
        ];

        $this->validate($request, $rules, $customMessages);

        $variant = new ModelsVariant;
        $variant->name = $request->nama;
        $variant->price = $request->harga;
        $variant->save();

        return response()->json(['success' => 'Data Varian Saos Berhasil Ditambah!']);
    }

    public function update(Request $request)
    {
        $variant = new ModelsVariant;
        $data = $variant->find($request->id);
        if ($data) {
            $rules = [
                'nama_ubah' => 'required',
                'harga_ubah' => 'required|numeric',
            ];

            $customMessages = [
                'required' => 'Mohon isi :attribute varian saos!',
                'numeric' => 'Hanya angka yang diperbolekan!',
            ];

            $this->validate($request, $rules, $customMessages);

            $data->name = $request->nama_ubah;
            $data->price = $request->harga_ubah;
            $data->save();

            return response()->json(['success' => 'Data Varian Saos Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Varian Saos Invalid!']);
        }
    }

    public function destroy(Request $request)
    {
        ModelsVariant::find($request->id)->delete();

        return response()->json(['success' => 'Data Varian Saos Berhasil Dihapus!']);
    }
}
