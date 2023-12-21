<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;

class ProdiController extends Controller
{
    // Jurusan
    public function index(){
        return view('Ketua_Jurusan.master.prodi');
    }

    public function data(){
        $prodi = Prodi::all();
        return response()->json(['data' => $prodi]);
    }

    public function create(Request $request){
        $data = Prodi::orderBy('kode_prodi', 'DESC')->first();
        $id;

        if($data == null){
            $id = "P01";
        }else{
            $newId = substr($data->kode_prodi, 2,1);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1){
                $id = "P0" .$tambah;
            }else if (strlen($tambah) == 2){
                $id = "P" .$tambah;
            }
        }

        Prodi::create([
            'kode_prodi' => $id,
            'nama_prodi' => $request->prodi,
            'jenjang_pendidikan' => $request->jenjang,
        ]);

        return redirect()->route('jurusan.prodi')->with('success', 'Data Berhasil Di Simpan');
    }

    public function edit($id){
        $prodi = Prodi::where('kode_prodi',$id)->get();
        return $prodi->toJson();
    }

    public function update(Request $request, $id){
        $prodi = Prodi::where('kode_prodi', $id)->first();

        $prodi->nama_prodi  = $request->prodi;
        $prodi->jenjang_pendidikan  = $request->jenjang;
        
        $prodi->save();

        return redirect()->route('jurusan.prodi')->with('success', 'Data Berhasil Di Ubah');
    }

    public function delete($id){
        Prodi::where('kode_prodi',$id)->delete();
    }
    // End Jurusan
}
