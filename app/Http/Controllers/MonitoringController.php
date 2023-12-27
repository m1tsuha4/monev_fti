<?php

namespace App\Http\Controllers;

use App\Models\DosenKelas;
use Illuminate\Http\Request;
use App\Models\KelasPerkuliahan;
use App\Models\Monitoring;
use App\Models\HasilVerifikasi;
use App\Models\BerkasDokumen;
use App\Models\JenisKelengkapanDokumen;
use App\Models\DetailHasilVerifikator;
use App\Models\JenisSoalUjian;
use App\Models\TipePenilaianSoal;
use Carbon\Carbon;
use DB;

class MonitoringController extends Controller
{
    // Dosen

    public function dosen_index($id){
//        $data = KelasPerkuliahan::where([
//            'id_kelas_perkuliahan'=> $id,
//            'status' => 2
//            ])->with('matakuliah')->get();
        $data = DB::table('kelas_perkuliahans')
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen','dosen.nip_dosen','=','dosen_kelas.nip_dosen')
            ->join('kurikulums','matakuliahs.tahun_kurikulum','=','kurikulums.id')
            ->where([
                ['kelas_perkuliahans.id_kelas_perkuliahan', '=', $id],
                ['tahun_akademik.status', '=', 1]
            ])
            ->get();
//        dd($data);
        $data_monitoring = DB::table('monitoringbap')
            ->where('id_kelas_perkuliahan','=',$id)
            ->get();
//        dd($data_monitoring);
//        $monitoring = HasilVerifikasi::where([['id_kelasperkuliahan',$id],['status',2]])->get();
//
//        $data_monitoring = DB::table('hasilverifikasi')->where([['hasilverifikasi.id_kelasperkuliahan','=',$id],['hasilverifikasi.status','=',2]])
//        ->join('monitoring','hasilverifikasi.id_hasilverifikasi','=','monitoring.id_hasilverifikasi')
//        ->get();
        // return $data;
        return view('Dosen.Perkuliahan.detail1', compact('data','data_monitoring'));
    }

    public function dosen_create(Request $request){
        $id = auth()->user()->nip_dosen;
        $file = $request->file('bukti');
            if ($file != null){
                if ($file->isValid()) {
                    $path = $file->store('public/bukti');

                    Monitoring::create([
                        'pertemuan' => $request->pertemuan,
                        'nip_dosen' => $id,
                        'id_kelas_perkuliahan' => $request->hasil_verifikasi,
                        'jumlah_mahasiswa_hadir' => $request->jumlah,
                        'tanggal' => $request->tanggal,
                        'materi' => $request->materi,
                        'jam_mulai' => $request->jam_mulai,
                        'jam_selesai' => $request->jam_selesai,
                        'rencana_pembelajaran' => $request->rencana_pembelajaran,
                        'realisasi_pembelajaran' => $request->realisasi_pembelajaran,
                        'assesment' => $request->assesment,
                        'bukti' => $path,
                    ]);
                    $countMonitoring = Monitoring::where('id_kelas_perkuliahan', $request->hasil_verifikasi)->count();

                    if ($countMonitoring >= 8 && $countMonitoring < 16) {
                        // Update the kelas_perkuliahan table with timeline = 2
                        KelasPerkuliahan::where('id_kelas_perkuliahan', $request->hasil_verifikasi)->update(['timeline_perkuliahan' => 2]);
                    } elseif ($countMonitoring >= 16) {
                        // Update the kelas_perkuliahan table with timeline = 3
                        KelasPerkuliahan::where('id_kelas_perkuliahan', $request->hasil_verifikasi)->update(['timeline_perkuliahan' => 3]);
                    }

                    return redirect()->route('dosen.kelas-perkuliahan')->with('success', 'Data Berhasil Di Simpan');
                }
            }
    }

    // End Dosen

    // Verifikator

    public function verifikator_index(){
        $id = auth()->user()->nip_dosen;
//        $data = HasilVerifikasi::where('nip_dosen',$id)->orderBy('status','ASC')->with('kelas_perkuliahan.matakuliah','kelas_perkuliahan.dosen_pengampu')->get();
//        $data = DosenKelas::where('nip_dosen', $id)
//            ->join('kelas_perkuliahans', 'kelas_perkuliahans.id_kelas_perkuliahan', '=', 'dosen_kelas.id_kelas_perkuliahan')
//            ->get();
        $data = DB::table('kelas_perkuliahans')
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen','dosen.nip_dosen','=','dosen_kelas.nip_dosen')
            ->join('kurikulums','matakuliahs.tahun_kurikulum','=','kurikulums.id')
            ->where('kelas_perkuliahans.dosen_verifikator', '=', $id)
            ->get();

        return view('Dosen.Verifikator.index', compact('data'));
    }

    public function verifikator_detail($id){
        $data = KelasPerkuliahan::where('id_kelas_perkuliahan',$id)->first();
        $data_soal = BerkasDokumen::where('id_kelas_perkuliahan',$id)->latest()->first();
        // dd($data_soal);
        // $berkas = BerkasDokumen::join('kategoriberkas','kategoriberkas.id','=','berkasdokumens.id_kategori_berkas')->where([['kategori',$data->timeline_perkuliahan],['id_kelas_perkuliahan',$data->id_kelas_perkuliahan]])
        //             ->get();

        if($data->timeline_perkuliahan == 1){
//            $berkas = BerkasDokumen::where([['id_kelasperkuliahan',$data->id_kelasperkuliahan],['id_kategori_berkas','!=','B04'],['id_kategori_berkas','!=','B05']])->with('kategori_berkas')->get();
            $berkas = KelasPerkuliahan::where('id_kelas_perkuliahan', $data->id_kelas_perkuliahan)->get();
            // $berkas_soal = BerkasDokumen::where('id_kelas_perkuliahan', $data->id_kelas_perkuliahan)->get();
            $kategori = JenisKelengkapanDokumen::get();
            return view('Dosen.Verifikator.detail', compact('data','berkas','kategori'));
        }else if($data->timeline_perkuliahan == 2){
            // $berkas = KelasPerkuliahan::where('id_kelas_perkuliahan', $data->id_kelas_perkuliahan)->get();
            $berkas_soal = BerkasDokumen::where('id_kelas_perkuliahan', $data->id_kelas_perkuliahan)->get();
            $kategori_soal = JenisSoalUjian::get();
            // dd($kategori_soal);
            return view('Dosen.Verifikator.detail', compact('data','data_soal','berkas_soal','kategori_soal'));
        }else{
            // $berkas = KelasPerkuliahan::where('id_kelas_perkuliahan', $data->id_kelas_perkuliahan)->get();
            $berkas_soal = BerkasDokumen::where('id_kelas_perkuliahan', $data->id_kelas_perkuliahan)->get();
            $kategori_soal = JenisSoalUjian::get();
            return view('Dosen.Verifikator.detail', compact('data','data_soal','berkas_soal','kategori_soal'));
        }
//        dd($kategori);
        // echo $berkas;

        // return view('Dosen.Verifikator.detail', compact('data','berkas', 'berkas_soal','kategori'));
    }

    public function verifikator_update(Request $request){
        if($request->id_kategori_berkas !== null || $request->id_kategori_berkas !== ""){
            BerkasDokumen::where([['id_soal',$request->id_kategori_berkas],['id_kelas_perkuliahan',$request->id_kelas_perkuliahan]])->update([
                'status' => $request->status,
                'keterangan' => $request->keterangan
            ]);
        }
        if($request->id_kategori_berkas === null || $request->id_kategori_berkas === ""){
            KelasPerkuliahan::where('id_kelas_perkuliahan',$request->id_kelas_perkuliahan)->update([
                'status' => $request->status,
                'keterangan' => $request->keterangan
            ]);
        }

        return back();
    }

    public function verifikator_create(Request $request){
        // dd($request->id_soal);
        if($request->id_soal !== null && $request->id_soal !== "" ){
            for($a = 0; $a < sizeof($request->nilai); $a++){
                TipePenilaianSoal::create([
                    'id_form_validasisoal' => $request->id_jenis_penilaian[$a],
                    'id_soal' => $request->id_soal,
                    'penilaian_soal' => $request->nilai[$a],
                    'keterangan' => $request->keterangan[$a],
                ]);
            }
        } else {
            for($a = 0; $a < sizeof($request->nilai); $a++){
                DetailHasilVerifikator::create([
                    'id_kelas_perkuliahan' => $request->id_hasil_verifikator,
                    'id_jenis_kelengkapan_dokumen' => $request->id_jenis_penilaian[$a],
                    'penilaian' => $request->nilai[$a],
                    'keterangan' => $request->keterangan[$a],
                ]);
            }
        }
        
        $now = Carbon::now();

        $file = $request->file('file');
            if ($file != null){
                if ($file->isValid()) {
                    $path = $file->store('public/ttd');
                    KelasPerkuliahan::where('id_kelas_perkuliahan', $request->id_hasil_verifikator)->update([
                        'status' => 2,
                        'tanggal_verifikasi' => $now,
                        'tanda_tangan_verifikator' => $path
                    ]);
                }
            }

        return redirect()->route('verifikator.monev');
    }
    // End Verifikator

    // GKM

    public function gkm_index(){
        $id = auth()->user()->kode_prodi;
        $data = DB::table('kelas_perkuliahans')
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen','dosen.nip_dosen','=','kelas_perkuliahans.dosen_verifikator')
            ->join('kurikulums','matakuliahs.tahun_kurikulum','=','kurikulums.id')
            ->where('tanda_tangan_verifikator','!=',null)
            ->get();
//        dd($data);
//        $data = HasilVerifikasi::where('tanda_tangan_verifikator','!=',null)->with('dosen_verifikator','kelas_perkuliahan.matakuliah')->get();
        return view('GKM.index', compact('data','id'));
    }

    public function gkm_detail($id){
        $data = DB::table('kelas_perkuliahans')
            ->select(
                'kelas_perkuliahans.*',
                'matakuliahs.*',
                'tahun_akademik.*',
                'dosen_kelas.*',
                'dosen_pengampu.nama_dosen AS nama_pengampu',
                'kelas_perkuliahans.dosen_verifikator AS nip_verifikator',
                'dosen_verifikator.nama_dosen AS nama_verifikator',
                'kurikulums.*'
            )
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen as dosen_pengampu', 'dosen_pengampu.nip_dosen', '=', 'dosen_kelas.nip_dosen')
            ->join('dosen as dosen_verifikator', 'dosen_verifikator.nip_dosen', '=', 'kelas_perkuliahans.dosen_verifikator')
            ->join('kurikulums', 'matakuliahs.tahun_kurikulum', '=', 'kurikulums.id')
            ->where('kelas_perkuliahans.id_kelas_perkuliahan', '=', $id)
            ->get();
        $dokumen = DB::table('tipe_penilaian_dokumen')
                ->join('form_kelengkapan_dokumen','form_kelengkapan_dokumen.id_jenis_kelengkapan_dokumen','=','tipe_penilaian_dokumen.id_jenis_kelengkapan_dokumen')
                ->where('id_kelas_perkuliahan', '=', $id)
                ->get();
        // $soal = DB::table('tipe_penilaian_soal')->where('id_kelas_perkuliahan', '=', $id)->get();
//        dd($data);
//        $data = DetailHasilVerifikator::where('id_hasilverifikasi', $id)->with('hasil_verifikasi.dosen_verifikator','hasil_verifikasi.kelas_perkuliahan.matakuliah','hasil_verifikasi.kelas_perkuliahan.dosen_pengampu','jenis_kelengkapan_berkas')->get();
        return view('GKM.detail', compact('data','dokumen'));
    }

    public function gkm_update(Request $request, $id){
        $file = $request->file('file');

        // dd($request);
        if ($file != null){
            if ($file->isValid()) {
                $path = $file->store('public/ttd');
                KelasPerkuliahan::where('id_kelas_perkuliahan', $id)->update([
                    'tanda_tangan_gkm' => $path
                ]);

                $data = KelasPerkuliahan::where('id_kelas_perkuliahan', $id)->first();
                if($data->timeline_perkuliahan == 3){
                    KelasPerkuliahan::where('id_kelas_perkuliahan', $data->id_kelas_perkuliahan)->update([
                        'status' => 2
                    ]);
                }
                return back();
            }
        }
    }

    // End GKM

    // Jurusan

    public function jurusan_monitoring_index(){
        $id = auth()->user()->kode_prodi;
        $data = DB::table('kelas_perkuliahans')
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen','dosen.nip_dosen','=','dosen_kelas.nip_dosen')
            ->join('kurikulums','matakuliahs.tahun_kurikulum','=','kurikulums.id')
            ->orderBy('kelas_perkuliahans.id_tahun_akademik','DESC')
            ->get();

//        dd($data);
//        $data = KelasPerkuliahan::with('dosen_pengampu','matakuliah')->orderBy('id_tahun_akademik','DESC')->get();
        return view('Ketua_jurusan.monitoring.index', compact('data','id'));
    }

    public function jurusan_monitoring_detail($id){
        $data = DB::table('kelas_perkuliahans')
            ->select(
                'kelas_perkuliahans.*',
                'matakuliahs.*',
                'tahun_akademik.*',
                'dosen_kelas.*',
                'dosen_pengampu.nama_dosen AS nama_pengampu',
                'kelas_perkuliahans.dosen_verifikator AS nip_verifikator',
                'dosen_verifikator.nama_dosen AS nama_verifikator',
                'kurikulums.*',
                'kelas_perkuliahans.status AS status_kelas_perkuliahan'
            )
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen as dosen_pengampu', 'dosen_pengampu.nip_dosen', '=', 'dosen_kelas.nip_dosen')
            ->join('dosen as dosen_verifikator', 'dosen_verifikator.nip_dosen', '=', 'kelas_perkuliahans.dosen_verifikator')
            ->join('kurikulums', 'matakuliahs.tahun_kurikulum', '=', 'kurikulums.id')
            ->where('kelas_perkuliahans.id_kelas_perkuliahan', '=', $id)
            ->get();
    //    dd($data);

//        $data1 = HasilVerifikasi::where('id_kelasperkuliahan',$id)->with('dosen_verifikator')->get();
//
        $data_monitoring = DB::table('monitoringbap')->where('monitoringbap.id_kelas_perkuliahan','=',$id)->get();

        // return $data;
        return view('Ketua_jurusan.monitoring.detail',compact('data','data_monitoring'));
    }

    public function jurusan_penilaian_index(){
        $id = auth()->user()->kode_prodi;
        $data = DB::table('kelas_perkuliahans')
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen','dosen.nip_dosen','=','dosen_kelas.nip_dosen')
            ->join('kurikulums','matakuliahs.tahun_kurikulum','=','kurikulums.id')
            ->orderBy('kelas_perkuliahans.id_tahun_akademik','DESC')
            ->get();
//        $data = KelasPerkuliahan::with('dosen_pengampu','matakuliah')->orderBy('id_tahun_akademik','DESC')->get();
        return view('Ketua_jurusan.laporan_penilaian.index',compact('data','id'));
    }

    public function jurusan_penilaian_detail($id){
        $data = DB::table('kelas_perkuliahans')
            ->select(
                'kelas_perkuliahans.*',
                'matakuliahs.*',
                'tahun_akademik.*',
                'dosen_kelas.*',
                'dosen_pengampu.nama_dosen AS nama_pengampu',
                'kelas_perkuliahans.dosen_verifikator AS nip_verifikator',
                'dosen_verifikator.nama_dosen AS nama_verifikator',
                'kurikulums.*',
                'kelas_perkuliahans.status AS status_kelas_perkuliahan'
            )
            ->join('matakuliahs', 'matakuliahs.kode_matakuliah', '=', 'kelas_perkuliahans.kode_matakuliah')
            ->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik', '=', 'kelas_perkuliahans.id_tahun_akademik')
            ->join('dosen_kelas', 'dosen_kelas.id_kelas_perkuliahan', '=', 'kelas_perkuliahans.id_kelas_perkuliahan')
            ->join('dosen as dosen_pengampu', 'dosen_pengampu.nip_dosen', '=', 'dosen_kelas.nip_dosen')
            ->join('dosen as dosen_verifikator', 'dosen_verifikator.nip_dosen', '=', 'kelas_perkuliahans.dosen_verifikator')
            ->join('kurikulums', 'matakuliahs.tahun_kurikulum', '=', 'kurikulums.id')
            ->where('kelas_perkuliahans.id_kelas_perkuliahan', '=', $id)
            ->get();
            // dd($data);
//        $data1 = HasilVerifikasi::where('id_kelasperkuliahan',$id)->with('dosen_verifikator')->get();

        return view('Ketua_jurusan.laporan_penilaian.detail', compact('data'));
    }

    // End Jurusan
}
