<?php

namespace App\Http\Controllers;

use App\Models\DosenKelas;
use App\Models\Kurikulum;
use Illuminate\Http\Request;
use App\Models\KelasPerkuliahan;
use App\Models\HasilVerifikasi;
use App\Models\User;
use App\Models\KategoriBerkas;
use App\Models\Matakuliah;
use App\Models\BerkasDokumen;
use App\Models\Monitoring;
use App\Models\TahunAkademik;
use Carbon\Carbon;
use Auth;
use DB;

class KelasPerkuliahanController extends Controller
{
    // jurusan

    public function index(){
        $id = auth()->user()->kode_prodi;

        $dosen = User::with('prodi')->get();

        $tahun_akademik = TahunAkademik::where('status',1)->get();

        $matakuliahs = [];  // Initialize the array
        $kurikulums = Kurikulum::where('kode_prodi', $id)->get();

        foreach ($kurikulums as $kurikulum) {
            $matakuliah = Matakuliah::where('tahun_kurikulum', $kurikulum->id)->get();
//            $matakuliahs = array_merge($matakuliahs, $matakuliah->toArray());
        }


        return view('Ketua_Jurusan.Perkuliahan.index',compact('matakuliah','dosen','tahun_akademik'));
    }
    // ->with('dosen_verifikator','kelas_perkuliahan.matakuliah','kelas_perkuliahan.dosen_pengampu')
    public function data(){
        $id = auth()->user()->kode_prodi;
        $matakuliahs = [];  // Initialize the array
        $kurikulums = Kurikulum::where('kode_prodi', $id)->get();

        foreach ($kurikulums as $kurikulum) {
            $matakuliah = Matakuliah::where('tahun_kurikulum', $kurikulum->id)->get();
//            $matakuliahs = array_merge($matakuliahs, $matakuliah->toArray());
        }

//        $KelasPerkuliahan = HasilVerifikasi::distinct('id_kelasperkuliahan')->with('dosen_verifikator','kelas_perkuliahan.matakuliah','kelas_perkuliahan.dosen_pengampu')->get(['id_kelasperkuliahan','nip_dosen']);
        $data = DB::table('kelas_perkuliahans')
//            ->whereIn('kelas_perkuliahans.kode_matakuliah', $matakuliah)
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen','dosen.nip_dosen','=','dosen_kelas.nip_dosen')
            ->get();

        return response()->json(['data' => $data]);

    }

    public function create(Request $request){
        if($request->dosen_pengampu !== null || $request->dosen_pengampu !== ""){
            $dosen = $request->dosen_pengampu;
            $id = $request->kode_kelasperkuliahan;
            $existingDosenKelas = DB::table('dosen_kelas')
                ->where('nip_dosen', $dosen)
                ->where('id_kelas_perkuliahan', $id)
                ->get();
//            dd($existingDosenKelas);
            if($existingDosenKelas->count()>0){
                return redirect()->route('jurusan.kelas_perkuliahan')->with('error', 'Data Sudah Tersedia');
            }
//            $existingKelasPerkuliahan = KelasPerkuliahan::where([
//                'kode_matakuliah' => $request->matakuliah,
//                'kelas' => $request->kelas,
//            ])->get();
//
//            if ($existingKelasPerkuliahan->count()>0) {
//                return redirect()->route('jurusan.kelas_perkuliahan')->with('error', 'Data Sudah Tersedia');
//            }

            $KelasPerkuliahan = KelasPerkuliahan::where('id_kelas_perkuliahan',$request->kode_kelasperkuliahan)->get();
            if($KelasPerkuliahan->count()>0)
            {
                return redirect()->route('jurusan.kelas_perkuliahan')->with('error', 'Data Sudah Tersedia');
            }

            KelasPerkuliahan::create([
                'id_kelas_perkuliahan' => $request->kode_kelasperkuliahan,
                'kode_matakuliah' => $request->matakuliah,
                'kelas' => $request->kelas,
                'keterangan' => null,
                'id_tahun_akademik' => $request->tahun_akademik,
                'file_rps' => null,
                'file_kontrak_perkuliahan' => null,
                'file_rtm' => null,
                'timeline_perkuliahan' => 1,
                'status' => 1,
                'dosen_verifikator' => $request->dosen_verifikator,
                'tanggal_verifikasi' => null,
                'tanda_tangan_gkm' => null,
                'tanda_tangan_verifikator' =>null,
                'catatan' => null,
                'komentar_perbaikan' => null,
            ]);

            DosenKelas::create([
                'nip_dosen' => $request->dosen_pengampu,
                'id_kelas_perkuliahan' => $request->kode_kelasperkuliahan,
            ]);

            $now = Carbon::now();

        }

        return redirect()->route('jurusan.kelas_perkuliahan')->with('success', 'Data Berhasil Di Simpan');
    }

    public function edit($id){
        $KelasPerkuliahan = KelasPerkuliahan::where('id_kelas_perkuliahan',$id)->get();
        return $KelasPerkuliahan->toJson();
    }

    public function update(Request $request, $id){
        $KelasPerkuliahan = KelasPerkuliahan::where('id_kelas_perkuliahan', $id)->first();
        $KelasPerkuliahan->kelas  = $request->kelas;
        $KelasPerkuliahan->id_tahun_akademik  = $request->tahun_akademik;
        $KelasPerkuliahan->dosen_verifikator = $request->dosen_verifikator;

        $KelasPerkuliahan->save();

        $dosenKelas = DosenKelas::where('id_kelas_perkuliahan', $id)->first();
        $dosenKelas->nip_dosen = $request->dosen_pengampu;
        $dosenKelas->save();

        return redirect()->route('jurusan.kelas_perkuliahan')->with('success', 'Data Berhasil Di Ubah');
    }

    public function delete($id){
        KelasPerkuliahan::where('id_kelas_perkuliahan',$id)->delete();
    }

    // end jurusan

    // Dosen

    public function dosen_index(){
//        $id = auth()->user()->nip_dosen;
//        $KelasPerkuliahan = DB::table('kelas_perkuliahans')
//            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
//            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
//            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
//            ->join('dosen','dosen.nip_dosen','=','dosen_kelas.nip_dosen')
//            ->join('kurikulums','matakuliahs.tahun_kurikulum','=','kurikulums.id')
//            ->where([
//                ['dosen_kelas.nip_dosen', '=', $id],
//                ['tahun_akademik.status', '=', 1]
//            ])
//            ->get();
//        dd($KelasPerkuliahan);
        return view('Dosen.Perkuliahan.index');
    }

    public function dosen_data(){
        $id = auth()->user()->nip_dosen;
        $KelasPerkuliahan = DB::table('kelas_perkuliahans')
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen','dosen.nip_dosen','=','dosen_kelas.nip_dosen')
            ->join('kurikulums','matakuliahs.tahun_kurikulum','=','kurikulums.id')
            ->where([
                ['dosen_kelas.nip_dosen', '=', $id],
                ['tahun_akademik.status', '=', 1]
            ])
            ->get();
//        $KelasPerkuliahan = DB::table('kelas_perkuliahans')
//            ->where([['kelasperkuliahan.nip_dosen','=',$id],['tahun_akademik.status','=',1]])
//        ->join('matakuliah','matakuliah.kode_matakuliah','=','kelasperkuliahan.kode_matakuliah')
//        ->join('tahun_akademik','tahun_akademik.id_tahun_akademik','=','kelasperkuliahan.id_tahun_akademik')
//        ->get();
        return response()->json(['data' => $KelasPerkuliahan]);
    }

    public function dosen_detail($id){
        $kelas = KelasPerkuliahan::where('id_kelas_perkuliahan',$id)->first();
        $berkas_soal = DB::table('berkas_soal')->where('id_kelas_perkuliahan',$id)->get();
        $berkas = KelasPerkuliahan::where('id_kelas_perkuliahan', $id)->get();
//        $kategori = KategoriBerkas::whereNotIn('kategori_berkas',[1])->get();
//        $berkas = BerkasDokumen::where('id_kelasperkuliahan',$id)->with('kategori_berkas')->get();
        return view('Dosen.Perkuliahan.detail', compact('kelas','berkas','berkas_soal'));
    }

    // End Dosen

}
