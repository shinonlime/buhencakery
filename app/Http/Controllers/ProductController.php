<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        return view('home')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tambah-produk');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'pict' => 'image|file'
        ]);

        // if($request->file('pict')){
        //     $validasi = $request->file('pict')->store('product-images');
        // }

        // $validasi['slug'] = Str::slug($request->name, '-');

        // Product::create($validasi);

        $product = new Product;

        $product->nama = $request->name;
        $product->slug = Str::slug($product->nama, '-');
        $product->harga = $request->price;
        $product->deskripsi = $request->description;
        $product->gambar = $request->file('pict')->store('product-images');

        $product->save();

        return redirect('/admin/produk')->with('success', 'Produk berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('detail-product')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        return view('admin.update-produk', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'pict' => 'image|file'
        ]);

        $slug = Str::slug($request->name, '-');
        if($request->file('pict')){
            $gambar = $request->file('pict')->store('product-images');
        } else {
            $gambar = $request->oldpict;
        }
       

        $product = DB::table('products')->where('id', $id)->update([
            'nama' => $request->name,
            'slug' => $slug,
            'harga' => $request->price,
            'deskripsi' => $request->description,
            'gambar' => $gambar
        ]);

        return redirect('/admin/dashboard')->with('success', 'Berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect('/admin/produk')->with('success', 'Berhasil dihapus!');
    }
}