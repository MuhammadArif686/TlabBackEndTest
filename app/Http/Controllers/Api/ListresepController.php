<?php

namespace App\Http\Controllers\Api;

use App\Models\Listresep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListresepResource;
use Illuminate\Support\Facades\Validator;

class ListresepController extends Controller
{    
    
    public function index()
    {
        $listresep = Listresep::latest()->paginate(5);

        return new ListresepResource(true, 'List Data Resep', $listresep);
    }

    public function store(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'id_kategori'    => 'required|numeric',
            'id_bahan'       => 'required|numeric',
            'nama_listresep'     => 'required'
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $listresep = Listresep::create([
            'id_kategori'    => $request->id_kategori,
            'id_bahan'       => $request->id_bahan,
            'nama_listresep'     => $request->nama_listresep
        ]);

        return new ListresepResource(true, 'Data Resep Berhasil Ditambahkan!', $listresep);
    }

    public function show(Listresep $listresep)
    {
        return new ListresepResource(true, 'Data Resep Ditemukan!', $listresep);
    }

    public function update(Request $request, Listresep $listresep)
    {
        
        $validator = Validator::make($request->all(), [
            'id_kategori'    => 'required|numeric',
            'id_bahan'       => 'required|numeric',
            'nama_listresep'     => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $listresep->update([
            'id_kategori'    => $request->id_kategori,
            'id_bahan'       => $request->id_bahan,
            'nama_listresep'     => $request->nama_listresep
        ]);

        
        return new ListresepResource(true, 'Data Resep Berhasil Diubah!', $listresep);
    }

    public function destroy(Listresep $listresep)
    {
       
        $listresep->delete();

        return new ListresepResource(true, 'Data Resep Berhasil Dihapus!', null);
    }


}