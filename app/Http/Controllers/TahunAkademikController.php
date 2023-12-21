<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TahunAkademik;

class TahunAkademikController extends Controller
{
    public function index(){
        return view('Ketua_Jurusan.master.tahun_akademik');
    }

    public function data(){
        $TahunAkademik = TahunAkademik::get();
        return response()->json(['data' => $TahunAkademik]);
    }

    public function create(Request $request){
        $data = TahunAkademik::orderBy('id_tahun_akademik', 'DESC')->first();
        $id;

        if($data == null){
            $id = 1;
        }else{
            $id = $data->id_tahun_akademik + 1;
        }
        
        TahunAkademik::create([
            'id_tahun_akademik' => $id,
            'tahun' => $request->tahun,
            'semester' => $request->semester,
            'status' => $request->status,
        ]);

        return redirect()->route('jurusan.tahun_akademik')->with('success', 'Data Berhasil Di Simpan');
    }

    public function edit($id){
        $TahunAkademik = TahunAkademik::where('id_tahun_akademik',$id)->get();
        return $TahunAkademik->toJson();
    }

    public function update(Request $request, $id){
        $TahunAkademik = TahunAkademik::where('id_tahun_akademik', $id)->first();

        $TahunAkademik->tahun  = $request->tahun;
        $TahunAkademik->semester  = $request->semester;
        $TahunAkademik->status  = $request->status;

        $TahunAkademik->save();

        return redirect()->route('jurusan.tahun_akademik')->with('success', 'Data Berhasil Di Ubah');
    }

    public function delete($id){
        TahunAkademik::where('id_tahun_akademik',$id)->delete();
    }
}
