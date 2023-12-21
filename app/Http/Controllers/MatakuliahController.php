<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Prodi;

class MatakuliahController extends Controller
{
    // Jurusan
    public function index(){
        $data = Kurikulum::all();
        return view('Ketua_Jurusan.master.matakuliah', compact('data'));
    }

    public function data(){
        $matakuliah = Matakuliah::with('kurikulum')->get();
        return response()->json(['data' => $matakuliah]);
    }

    public function create(Request $request){
        $matakuliah = Matakuliah::where('kode_matakuliah',$request->kode_matakuliah)->get();
        if($matakuliah->count()>0)
        {
            return redirect()->route('jurusan.matakuliah')->with('error', 'kode_matakuliah sudah tersedia');
        }
        Matakuliah::create([
            'kode_matakuliah' => $request->kode_matakuliah,
            'tahun_kurikulum' => $request->tahun_kurikulum,
            'nama_matakuliah' => $request->matakuliah,
            'kategori_matakuliah' => $request->kategori,
            'jumlah_kelas' => $request->jumlah_kelas,
            'estimasi_mahasiswa' => $request->kuota,
            'jumlah_sks' => $request->sks,
            'semester' => $request->semester,
        ]);

        return redirect()->route('jurusan.matakuliah')->with('success', 'Data Berhasil Di Simpan');
    }

    public function edit($id){
        $matakuliah = Matakuliah::where('kode_matakuliah',$id)->get();
        return $matakuliah->toJson();
    }

    public function update(Request $request, $id){
        $matakuliah = Matakuliah::where('kode_matakuliah', $id)->first();

        $matakuliah->tahun_kurikulum  = $request->tahun_kurikulum;
        $matakuliah->nama_matakuliah  = $request->matakuliah;
        $matakuliah->kategori_matakuliah  = $request->kategori;
        $matakuliah->jumlah_kelas  = $request->jumlah_kelas;
        $matakuliah->estimasi_mahasiswa  = $request->kuota;
        $matakuliah->jumlah_sks  = $request->sks;
        $matakuliah->semester  = $request->semester;

        $matakuliah->save();

        return redirect()->route('jurusan.matakuliah')->with('success', 'Data Berhasil Di Ubah');
    }

    public function delete($id){
        Matakuliah::where('kode_matakuliah',$id)->delete();
    }
    // End Jurusan
}
