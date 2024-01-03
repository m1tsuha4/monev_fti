<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index(){
        return view('Ketua_Jurusan.master.kurikulum');
    }

    public function data(){
        $Kurikulum =Kurikulum::get();
        return response()->json(['data' => $Kurikulum]);
    }

    public function create(Request $request){
        $data =Kurikulum::orderBy('id', 'DESC')->first();
        // $id;

        // if($data == null){
        //     $id = 1;
        // }else{
        //     $id = $data->id_tahun_akademik + 1;
        // }
        
       Kurikulum::create([
            // 'id_tahun_akademik' => $id,
            'tahun_kurikulum' => $request->tahun_kurikulum,
            'kode_prodi' => $request->kode_prodi,
            'status' => $request->status,
        ]);

        return redirect()->route('jurusan.kurikulum')->with('success', 'Data Berhasil Di Simpan');
    }

    public function edit($id){
        $Kurikulum =Kurikulum::where('id',$id)->get();
        return $Kurikulum->toJson();
    }

    public function update(Request $request, $id){
        $Kurikulum =Kurikulum::where('id', $id)->first();

        $Kurikulum->tahun_kurikulum  = $request->tahun_kurikulum;
        $Kurikulum->kode_prodi  = $request->kode_prodi;
        $Kurikulum->status  = $request->status;

        $Kurikulum->save();

        return redirect()->route('jurusan.kurikulum')->with('success', 'Data Berhasil Di Ubah');
    }

    public function delete($id){
       Kurikulum::where('id',$id)->delete();
    }
}
