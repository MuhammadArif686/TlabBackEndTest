<?php

namespace App\Http\Controllers\Api;

use App\Models\Resep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ResepResource;
use Illuminate\Support\Facades\Validator;

class ResepController extends Controller
{    
    
    public function index()
    {
        $resep = Resep::latest()->paginate(5);

        return new ResepResource(true, 'List Data Resep', $resep);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'nama_resep'     => 'required',
            'id_kategori'    => 'required|numeric',
            'id_bahan'       => 'required|numeric'
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $resep = Resep::create([
            'nama_resep'     => $request->nama_resep,
            'id_kategori'    => $request->id_kategori,
            'id_bahan'       => $request->id_bahan
        ]);

        return new ResepResource(true, 'Data Resep Berhasil Ditambahkan!', $resep);
    }

    public function show(Resep $resep)
    {
        return new ResepResource(true, 'Data Resep Ditemukan!', $resep);
    }

    public function update(Request $request, Resep $resep)
    {
        
        $validator = Validator::make($request->all(), [
            'nama_resep'     => 'required',
            'id_kategori'    => 'required|numeric',
            'id_bahan'       => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $resep->update([
            'nama_resep'     => $request->nama_resep,
            'id_kategori'    => $request->id_kategori,
            'id_bahan'       => $request->id_bahan
        ]);

        
        return new ResepResource(true, 'Data Resep Berhasil Diubah!', $resep);
    }

    public function destroy(Resep $resep)
    {
       
        $resep->delete();

        return new ResepResource(true, 'Data Resep Berhasil Dihapus!', null);
    }


}