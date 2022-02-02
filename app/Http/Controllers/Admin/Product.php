<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product as ModelsProduct;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Product extends Controller
{
    public function index()
    {
        $data['categories'] = Category::select('id', 'nama')->get();
        return view('admin.product.index')->with($data);
    }

    public function get_data()
    {
        $products = ModelsProduct::latest()->get();
        $data = array();
        $no = 1;
        foreach ($products as $product) {
            if ($product->best_seller == 0) {
                $best_seller = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-danger" disabled>TIDAK</button>
                <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a href="javascript:void(0)" class="dropdown-item" onclick="best_seller_ubah(' . "'" . $product->id . "'" . ',' . "'" . $product->best_seller . "'" . ')">YA</a>
                </div>
            </div>';
            } else {
                $best_seller = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-success" disabled>YA</button>
                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a href="javascript:void(0)" class="dropdown-item" onclick="best_seller_ubah(' . "'" . $product->id . "'" . ',' . "'" . $product->best_seller . "'" . ')">TIDAK</a>
                </div>
            </div>';
            }
            if ($product->in_stock == 0) {
                $in_stock = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-danger" disabled>TIDAK</button>
                <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a href="javascript:void(0)" class="dropdown-item" onclick="in_stock_ubah(' . "'" . $product->id . "'" . ',' . "'" . $product->in_stock . "'" . ')">YA</a>
                </div>
            </div>';
            } else {
                $in_stock = '<div class="btn-group">
                <button type="button" class="btn btn-sm btn-success" disabled>YA</button>
                <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                    <a href="javascript:void(0)" class="dropdown-item" onclick="in_stock_ubah(' . "'" . $product->id . "'" . ',' . "'" . $product->in_stock . "'" . ')">TIDAK</a>
                </div>
            </div>';
            }
            $row = array();
            $row[] = $no;
            $row[] = $product->nama . ' (' . $product->slug . ')';
            $row[] = $product->harga;
            $row[] = $product->category->nama;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Lihat Keterangan" onclick="keterangan_editor(' . "'" . $product->id . "'" . ',' . "'" . $product->nama . "'" . ',' . "'" . $product->keterangan . "'" . ')"><i class="far fa-sticky-note"></i> Lihat Keterangan</a>';
            $row[] = $best_seller;
            $row[] = $in_stock;
            $row[] = '<a class="btn btn-sm btn-success" href="javascript:void(0)" title="Image" onclick="custom_image(' . "'" . $product->id . "'" . ',' . "'" . $product->nama . "'" . ')"><i class="fas fa-plus-circle"></i> Image</a>
            <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Ubah" onclick="ubah_data(' . "'" . $product->id . "'" . ',' . "'" . $product->nama . "'" . ',' . "'" . $product->harga . "'" . ',' . "'" . $product->category->id . "'" . ')"><i class="far fa-edit"></i> Ubah</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="hapus_data(' . "'" . $product->id . "'" . ')"><i class="fas fa-trash-alt"></i> Hapus</a>';

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
            'kategori' => 'required',
        ];

        $customMessages = [
            'required' => 'Mohon isi :attribute produk!',
            'numeric' => 'Hanya angka yang diperbolehkan!',
        ];

        $this->validate($request, $rules, $customMessages);

        $slug = Str::slug($request->nama, '-');

        $product = new ModelsProduct;
        $product->nama = $request->nama;
        $product->slug = $slug;
        $product->harga = $request->harga;
        $product->category_id = $request->kategori;
        $product->save();

        return response()->json(['success' => 'Data Produk Berhasil Ditambah!']);
    }

    public function update(Request $request)
    {
        $product = new ModelsProduct;
        $data = $product->find($request->id);
        if ($data) {
            $rules = [
                'nama_ubah' => 'required',
                'harga_ubah' => 'required|numeric',
                'kategori_ubah' => 'required',
            ];

            $customMessages = [
                'required' => 'Mohon isi :attribute produk!',
                'numeric' => 'Hanya angka yang diperbolehkan!',
            ];

            $this->validate($request, $rules, $customMessages);

            $slug = Str::slug($request->nama_ubah, '-');

            $data->nama = $request->nama_ubah;
            $data->slug = $slug;
            $data->harga = $request->harga_ubah;
            $data->category_id = $request->kategori_ubah;
            $data->save();

            return response()->json(['success' => 'Data Produk Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Produk Invalid!']);
        }
    }

    public function destroy(Request $request)
    {
        ModelsProduct::find($request->id)->delete();

        return response()->json(['success' => 'Data Produk Berhasil Dihapus!']);
    }

    public function seller_ubah(Request $request)
    {
        $product = new ModelsProduct;
        $data = $product->find($request->id);
        if ($data) {
            if ($request->seller == 1) {
                $data->best_seller = 0;
            } else {
                $data->best_seller = 1;
            }
            $data->save();

            return response()->json(['success' => 'Data Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Invalid!']);
        }
    }

    public function stock_ubah(Request $request)
    {
        $product = new ModelsProduct;
        $data = $product->find($request->id);
        if ($data) {
            if ($request->stock == 1) {
                $data->in_stock = 0;
            } else {
                $data->in_stock = 1;
            }
            $data->save();

            return response()->json(['success' => 'Data Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Invalid!']);
        }
    }

    public function keterangan_ubah(Request $request)
    {
        $product = new ModelsProduct;
        $data = $product->find($request->id);
        if ($data) {
            $data->keterangan = $request->keterangan;
            $data->save();

            return response()->json(['success' => 'Keterangan Berhasil Diubah!!']);
        } else {
            return response()->json(['error' => 'Data Invalid!']);
        }
    }

    public function image_list(Request $request)
    {
        $products = ModelsProduct::find($request->id);
        $data = "";
        if ($products->product_images->count() > 0) {
            foreach ($products->product_images as $img_product) {
                $data .= "<div class='col-sm-2 text-center'><a href='javascript:void(0)' class='btn btn-sm btn-danger mb-2' onclick='delete_image(" . $img_product->id . ")'><i class='far fa-trash-alt'></i></a><a href='" . asset('assets/image_produk/' . $img_product->nama) . "' data-toggle='lightbox' data-title='" . $img_product->nama . "' data-gallery='gallery'><img src='" . asset('assets/image_produk/' . $img_product->nama) . "' class='img-fluid mb-2' alt='" . $img_product->nama . "'/></a></div>";
            }
        } else {
            $data .= "<div class='col-lg-12 text-center text-danger'>Tidak Ada File Gambar Yang Ditemukan.</div>";
        }

        $output = array(
            "data" => $data,
        );
        return response()->json($output);
    }

    public function image_upload(Request $request)
    {
        $rules = [
            'produk_image' => 'required|image|max:1024',
        ];

        $customMessages = [
            'required' => 'Mohon pilih file yang ingin diunggah!',
            'image' => 'Pastikan file yang anda unggah adalah file gambar!',
            'max' => 'Pastikan file yang anda unggah berukuran maksimal 1MB!',
        ];

        $this->validate($request, $rules, $customMessages);

        $data = ModelsProduct::find($request->id);
        if ($data) {
            if ($data->product_images->count() < 6) {
                $image = $request->produk_image;
                $namaFile = time() . rand(100, 999) . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/assets/image_produk', $namaFile);

                $file = new ProductImage;
                $file->product_id = $request->id;
                $file->nama = $namaFile;
                $file->save();

                return response()->json([
                    'type' => 'success',
                    'message' => 'File Gambar Berhasil Diunggah!'
                ]);
            } else {
                return response()->json([
                    'type' => 'error',
                    'message' => 'Tiap Produk Maksimal Memiliki 6 Gambar!'
                ]);
            }
        } else {
            return response()->json([
                'type' => 'error',
                'message' => 'Data Invalid'
            ]);
        }
    }

    public function image_delete(Request $request)
    {
        $image = ProductImage::find($request->id);
        if ($image) {
            $file = public_path('/assets/image_produk/') . $image->nama;
            if (file_exists($file)) {
                @unlink($file);
            }
            $image->delete();

            return response()->json(['success' => 'File Gambar Berhasil Dihapus!']);
        } else {
            return response()->json(['error' => 'Data Invalid!']);
        }
    }
}
