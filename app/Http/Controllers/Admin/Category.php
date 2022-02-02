<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category as CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Category extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function get_data()
    {
        $categories = CategoryModel::latest()->get();
        $data = array();
        $no = 1;
        foreach ($categories as $category) {
            if ($category->varian == 0) {
                $varian = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-danger" disabled>TIDAK</button>
                <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a href="javascript:void(0)" class="dropdown-item" onclick="varian_ubah(' . "'" . $category->id . "'" . ',' . "'" . $category->varian . "'" . ')">YA</a>
                </div>
            </div>';
            } else {
                $varian = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-success" disabled>YA</button>
                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a href="javascript:void(0)" class="dropdown-item" onclick="varian_ubah(' . "'" . $category->id . "'" . ',' . "'" . $category->varian . "'" . ')">TIDAK</a>
                </div>
            </div>';
            }
            $row = array();
            $row[] = $no;
            $row[] = $category->nama . ' (' . $category->slug . ')';
            $row[] = $varian;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="ubah_data(' . "'" . $category->id . "'" . ',' . "'" . $category->nama . "'" . ',' . "'" . $category->varian . "'" . ')"><i class="far fa-edit"></i> Ubah</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data(' . "'" . $category->id . "'" . ')"><i class="fas fa-trash-alt"></i> Hapus</a>';

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
            'varian' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon isi :attribute kategori!',
        ];

        $this->validate($request, $rules, $customMessages);

        $slug = Str::slug($request->nama, '-');

        $category = new CategoryModel;
        $category->nama = $request->nama;
        $category->slug = $slug;
        $category->varian = $request->varian;
        $category->save();

        return response()->json(['success' => 'Data Kategori Berhasil Ditambah!']);
    }

    public function update(Request $request)
    {
        $category = new CategoryModel;
        $data = $category->find($request->id);
        if ($data) {
            $rules = [
                'nama_ubah' => 'required',
                'varian_ubah' => 'required',
            ];

            $customMessages = [
                'required' => 'Mohon isi :attribute kategori!',
            ];

            $this->validate($request, $rules, $customMessages);

            $slug = Str::slug($request->nama_ubah, '-');

            $data->nama = $request->nama_ubah;
            $data->slug = $slug;
            $data->varian = $request->varian_ubah;
            $data->save();

            return response()->json(['success' => 'Data Kategori Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Kategori Invalid!']);
        }
    }

    public function destroy(Request $request)
    {
        CategoryModel::find($request->id)->delete();

        return response()->json(['success' => 'Data Kategori Berhasil Dihapus!']);
    }

    public function varian_ubah(Request $request)
    {
        $category = new CategoryModel;
        $data = $category->find($request->id);
        if ($data) {
            if ($request->varian == 1) {
                $data->varian = 0;
            } else {
                $data->varian = 1;
            }
            $data->save();

            return response()->json(['success' => 'Data Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Invalid!']);
        }
    }
}
