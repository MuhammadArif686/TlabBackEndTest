<?php

namespace App\Http\Controllers\Api;

use App\Models\Bahan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BahanResource;
use Illuminate\Support\Facades\Validator;

class BahanController extends Controller
{    
    
    public function index()
    {
        $bahan = Bahan::latest()->paginate(5);

        return new BahanResource(true, 'List Data Bahan', $bahan);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'nama_bahan'     => 'required'
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bahan = Bahan::create([
            'nama_bahan'     => $request->nama_bahan
        ]);

        return new BahanResource(true, 'Data Bahan Berhasil Ditambahkan!', $bahan);
    }

    public function show(Bahan $bahan)
    {
        return new BahanResource(true, 'Data Bahan Ditemukan!', $bahan);
    }

    public function update(Request $request, Bahan $bahan)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_bahan'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $bahan->update([
            'nama_bahan'     => $request->nama_bahan
        ]);

        
        return new BahanResource(true, 'Data Bahan Berhasil Diubah!', $bahan);
    }

    public function destroy(Bahan $bahan)
    {
       
        $bahan->delete();

        return new BahanResource(true, 'Data Bahan Berhasil Dihapus!', null);
    }


}