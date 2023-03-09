<?php

namespace App\Http\Controllers\Api;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{    
    
    public function index()
    {
        $kategori = Kategori::latest()->paginate(5);

        return new KategoriResource(true, 'List Data Posts', $kategori);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'nama_kategori'     => 'required'
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kategori = Kategori::create([
            'nama_kategori'     => $request->nama_kategori
        ]);

        return new KategoriResource(true, 'Data Kategori Berhasil Ditambahkan!', $kategori);
    }

    public function show(Kategori $kategori)
    {
        return new KategoriResource(true, 'Data Kategori Ditemukan!', $kategori);
    }

    public function update(Request $request, Kategori $kategori)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_kategori'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $kategori->update([
            'nama_kategori'     => $request->nama_kategori
        ]);

        
        return new KategoriResource(true, 'Data Kategori Berhasil Diubah!', $kategori);
    }

    public function destroy(Kategori $kategori)
    {
       
        $kategori->delete();

        return new KategoriResource(true, 'Data Kategori Berhasil Dihapus!', null);
    }


}