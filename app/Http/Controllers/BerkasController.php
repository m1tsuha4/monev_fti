<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBerkas;
use App\Models\JenisKelengkapanDokumen;
use App\Models\BerkasDokumen;
use App\Models\KelasPerkuliahan;
use App\Models\KontrakPerkuliahan;
use App\Models\DetailHasilVerifikator;
use App\Models\HasilVerifikasi;
use App\Models\JenisSoalUjian;
use App\Models\Monitoring;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use DB;
use PDF;

class BerkasController extends Controller
{
    // Kategori Berkas Master

    public function index(){
        return view('Ketua_Jurusan.master.kategori_berkas');
    }

    public function data(){
        $kategoriberkas = KategoriBerkas::get();
        return response()->json(['data' => $kategoriberkas]);
    }

    public function create(Request $request){
        $data = KategoriBerkas::orderBy('id_kategori_berkas', 'DESC')->first();
        $id;

        if($data == null){
            $id = "B01";
        }else{
            $newId = substr($data->id_kategori_berkas, 2,1);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1){
                $id = "B0" .$tambah;
            }else if (strlen($tambah) == 2){
                $id = "B" .$tambah;
            }
        }

        KategoriBerkas::create([
            'id_kategori_berkas' => $id,
            'nama_berkas' => $request->nama_berkas,
            'kategori_berkas' => $request->kategori,
        ]);

        return redirect()->route('jurusan.kategori_berkas')->with('success', 'Data Berhasil Di Simpan');
    }

    public function edit($id){
        $kategoriberkas = KategoriBerkas::where('id_kategori_berkas',$id)->get();
        return $kategoriberkas->toJson();
    }

    public function update(Request $request, $id){
        $kategoriberkas = KategoriBerkas::where('id_kategori_berkas', $id)->first();

        $kategoriberkas->nama_berkas  = $request->nama_berkas;
        $kategoriberkas->kategori_berkas  = $request->kategori_berkas;

        $kategoriberkas->save();

        return redirect()->route('jurusan.kategori_berkas')->with('success', 'Data Berhasil Di Ubah');
    }

    public function delete($id){
        KategoriBerkas::where('id_kategori_berkas',$id)->delete();
    }

    // End Kategori Berkas Master

    // Kategori Penilaian Master

    public function penilaian_index(){
        return view('Ketua_Jurusan.master.penilaian');
    }

    public function penilaian_data(){
        $JenisKelengkapanDokumen = JenisKelengkapanDokumen::get();
        $JenisKelengkapanSoal = JenisSoalUjian::get();
        return response()->json([
            'data_dokumen' => $JenisKelengkapanDokumen,
            'data_soal' => $JenisKelengkapanSoal,
        ]);
    }

    public function penilaian_create(Request $request){
        $data = JenisKelengkapanDokumen::orderBy('id_jenis_kelengkapan_dokumen', 'DESC')->first();
        $data_soal = JenisSoalUjian::orderBy('id_form_validasisoal', 'DESC')->first();
        $jenis = $request->jenis_kelengkapan;
        // dd($test);
        if($jenis == 1){
            if($data == null){
                $id = "P01";
            }else{
                $newId = substr($data->id_jenis_kelengkapan_dokumen, 1,2);
                $tambah = (int)$newId + 1;
                if (strlen($tambah) == 1){
                    $id = "P0" .$tambah;
                }else if (strlen($tambah) == 2){
                    $id = "P" .$tambah;
                }
            }
    
            JenisKelengkapanDokumen::create([
                'id_jenis_kelengkapan_dokumen' => $id,
                'point_penilaian_kelengkapan_dokumen' => $request->kelengkapan_dokumen,
                'tipe_penilaian' => $request->tipe_penilaian,
            ]);
        } elseif($jenis == 2){
            if($data_soal == null){
                $id = "S01";
            }else{
                $newId = substr($data_soal->id_form_validasisoal, 1,2);
                $tambah = (int)$newId + 1;
                if (strlen($tambah) == 1){
                    $id = "S0" .$tambah;
                }else if (strlen($tambah) == 2){
                    $id = "S" .$tambah;
                }
            }
    
            JenisSoalUjian::create([
                'id_form_validasisoal' => $id,
                'kriteria_penilaian' => $request->kelengkapan_dokumen,
                'point_penilaian' => $request->tipe_penilaian,
            ]);
        }
        // $id;

        

        return redirect()->route('jurusan.kategori_penilaian')->with('success', 'Data Berhasil Di Simpan');
    }

    public function penilaian_edit($id){

        $JenisKelengkapanDokumen = JenisKelengkapanDokumen::where('id_jenis_kelengkapan_dokumen',$id)->get();

        return $JenisKelengkapanDokumen->toJson();
    }

    public function penilaian_update(Request $request, $id){
        $JenisKelengkapanDokumen = JenisKelengkapanDokumen::where('id_jenis_kelengkapan_dokumen', $id)->first();

        $JenisKelengkapanDokumen->point_penilaian_kelengkapan_dokumen  = $request->kelengkapan_dokumen;
        $JenisKelengkapanDokumen->tipe_penilaian  = $request->tipe_penilaian;

        $JenisKelengkapanDokumen->save();

        return redirect()->route('jurusan.kategori_penilaian')->with('success', 'Data Berhasil Di Ubah');
    }

    public function penilaian_delete($id){
        JenisKelengkapanDokumen::where('id_jenis_kelengkapan_dokumen',$id)->delete();
    }

    // End Kategori Penilaian Master

    // Dosen Pengampu
    public function detail_kontrak($id){
        $matakuliah = BerkasDokumen::where('id_berkas',$id)->with('kelas_perkuliahan.matakuliah')->get();
        $kontrak = KontrakPerkuliahan::where('berkas_id',$id)->get();

        return view('Dosen.Perkuliahan.Kontrak.index', compact('kontrak','matakuliah'));
    }

    public function create_kontrak($id){
        $data = KelasPerkuliahan::where('id',$id)->with('matakuliah')->first();
        return view('Dosen.Perkuliahan.Kontrak.create', compact('id','data'));
    }

    public function store_kontrak(Request $request){
        $now = Carbon::now();

        $data = BerkasDokumen::create([
            'id_kelasperkuliahan' => $request->kelas_perkuliahan,
            'id_kategori_berkas' => 'B03',
            'file_berkas' => null,
            'tanggal_upload' => $now,
            'status' => 1,
            'keterangan' => "",
        ]);

        KontrakPerkuliahan::create([
            'uraian' => 'Rencana Pembelajaran Semester/Silabus',
            'keterangan' => $request->summary_ckeditor[0],
            'berkas_id' => $data->id
        ]);

        KontrakPerkuliahan::create([
            'uraian' => 'Metode/Sistem/Model Perkuliahan yang diterapkan',
            'keterangan' => $request->summary_ckeditor[1],
            'berkas_id' => $data->id
        ]);

        KontrakPerkuliahan::create([
            'uraian' => 'Buku perkuliahan yang digunakan beserta nama pengarangnya',
            'keterangan' => $request->summary_ckeditor[2],
            'berkas_id' => $data->id
        ]);

        KontrakPerkuliahan::create([
            'uraian' => 'Bobot kriteria penilaian',
            'keterangan' => $request->summary_ckeditor[3],
            'berkas_id' => $data->id
        ]);

        return redirect()->route('dosen.kelas-perkuliahan')->with('success', 'Data Berhasil Di Ubah');
    }

    public function edit_kontrak($id){
        $data = KontrakPerkuliahan::where('berkas_id',$id)->get();

        return view('Dosen.Perkuliahan.Kontrak.edit', compact('data'));
    }

    public function update_kontrak(Request $request){
        KontrakPerkuliahan::where('id',$request->id[0])->update([
            'keterangan' => $request->summary_ckeditor[0],
        ]);

        KontrakPerkuliahan::where('id',$request->id[1])->update([
            'keterangan' => $request->summary_ckeditor[1],
        ]);

        KontrakPerkuliahan::where('id',$request->id[2])->update([
            'keterangan' => $request->summary_ckeditor[2],
        ]);

        KontrakPerkuliahan::where('id',$request->id[3])->update([
            'keterangan' => $request->summary_ckeditor[3],
        ]);

        return back();
    }

    public function upload_berkas(Request $request, $id){
        $now = Carbon::now();
        $data_kelas = KelasPerkuliahan::where('id_kelas_perkuliahan', $request->id_kelas)->first();
        if($id == 1) {
            $file1 = $request->file('rps');
            $file2 = $request->file('rtm');
            $file3 = $request->file('kontrak');
            // $file4 = $request->file('bap');
            if ($file1 != null) {
                if ($file1->isValid()) {
                    $path = $file1->store('public/dokumen');
                    $data_kelas->file_rps = $path;
                    $data_kelas->save();
//                    BerkasDokumen::create([
//                        'id_kelasperkuliahan' => $request->id_kelas,
//                        'id_kategori_berkas' => $request->kategori_rps,
//                        'file_berkas' => $path,
//                        'tanggal_upload' => $now,
//                        'status' => 1,
//                        'keterangan' => "",
//                    ]);
                }
            }

            if ($file2 != null) {
                if ($file2->isValid()) {
                    $path = $file2->store('public/dokumen');
                    $data_kelas->file_rtm = $path;
                    $data_kelas->save();
                }
            }

            if ($file3 != null) {
                if ($file3->isValid()) {
                    $path = $file3->store('public/dokumen');
                    $data_kelas->file_kontrak_perkuliahan = $path;
                    $data_kelas->save();
                }
            }

        }else{
//            $data = HasilVerifikasi::where('id_kelasperkuliahan',$request->id_kelas1)->first();
//
//            $data1 = HasilVerifikasi::orderBy('id_hasilverifikasi', 'DESC')->first();
//            $id1;
//
//            if($data1 == null){
//                $id1 = "V000000001";
//            }else{
//                $newId = substr($data1->id_hasilverifikasi, 1,9);
//                $tambah = (int)$newId + 1;
//                if (strlen($tambah) == 1){
//                    $id1 = "V00000000" .$tambah;
//                }else if (strlen($tambah) == 2){
//                    $id1 = "V0000000" .$tambah;
//                }else if (strlen($tambah) == 3){
//                    $id1 = "V000000" .$tambah;
//                }else if (strlen($tambah) == 4){
//                    $id1 = "V00000" .$tambah;
//                }else if (strlen($tambah) == 5){
//                    $id1 = "V0000" .$tambah;
//                }else if (strlen($tambah) == 6){
//                    $id1 = "V000" .$tambah;
//                }else if (strlen($tambah) == 7){
//                    $id1 = "V00" .$tambah;
//                }else if (strlen($tambah) == 8){
//                    $id1 = "V0" .$tambah;
//                }else if (strlen($tambah) == 9){
//                    $id1 = "V" .$tambah;
//                }
//            }
//
//            $kategori;
//
//            if($request->id_kategori == "B04"){
//                $kategori = 2;
//            }else{
//                $kategori = 3;
//            }
//
//            HasilVerifikasi::create([
//                'id_hasilverifikasi' => $id1,
//                'nip_dosen' => $data->nip_dosen,
//                'id_kelasperkuliahan' => $request->id_kelas1,
//                'timeline_perkuliahan' => $kategori,
//                'status' => 1,
//                'tanggal_verifikasi' => null,
//                'tanda_tangan_verifikator' => null,
//                'tanda_tangan_gkm' => null,
//                'catatan' => null,
//            ]);
//
            $file = $request->file('berkas');
            if ($file != null){
                if ($file->isValid()) {
                    $path = $file->store('public/dokumen');
                    BerkasDokumen::create([
                        'id_kelas_perkuliahan' => $request->id_kelas1,
                        'id_soal' => $request->id_soal,
                        'nama_soal' => $request->nama_soal,
                        'file_soal' => $path,
                        'status' => 1,
                    ]);
                }
            }
        }

        return redirect()->route('dosen.kelas-perkuliahan')->with('success', 'Data Berhasil Di Ubah');
    }

    public function edit_berkas($id, $id1){
        $BerkasDokumen = BerkasDokumen::where([['id_kelasperkuliahan',$id1],['id_kategori_berkas', $id]])->get();
        return $BerkasDokumen->toJson();
    }

    public function update_berkas(Request $request, $id){
        $now = Carbon::now();
        $file = $request->file('berkas');
            if ($file != null){
                if ($file->isValid()) {
                    $path = $file->store('public/dokumen');
                    BerkasDokumen::where([['id_kelasperkuliahan',$id],['id_kategori_berkas', $request->kategori_berkas]])->update([
                        'file_berkas' => $path,
                        'tanggal_upload' => $now,
                        'status' => 1,
                        'keterangan' => "",
                    ]);
                }
            }

        return redirect()->route('dosen.kelas-perkuliahan')->with('success', 'Data Berhasil Di Ubah');
    }

    // End Dosen Pengampu

    // Check Berkas

    public function verifikator_kontrak($id){
        $matakuliah = BerkasDokumen::where('id_berkas',$id)->with('kelas_perkuliahan.matakuliah')->get();
        $kontrak = KontrakPerkuliahan::where('berkas_id',$id)->get();

        return view('Dosen.Verifikator.kontrak', compact('kontrak','matakuliah'));

    }

    public function pdf($id, $id1){
//        if($request->id_kategori_berkas !== null || $request->id_kategori_berkas !== ""){
//            BerkasDokumen::where([['id_soal',$request->id_kategori_berkas],['id_kelas_perkuliahan',$request->id_kelas_perkuliahan]])->update([
//                'status' => $request->status,
//            ]);
//        }
//        if($request->id_kategori_berkas === null || $request->id_kategori_berkas === ""){
//            KelasPerkuliahan::where('id_kelas_perkuliahan',$request->id_kelas_perkuliahan)->update([
//                'status' => $request->status,
//                'keterangan' => $request->keterangan
//            ]);
//        }
        $file = BerkasDokumen::where([['id_kelas_perkuliahan',$id1],['id_soal',$id]])->first();

        $path = storage_path('app/'. $file->file_soal);

        return response()->file($path);
    }
    public function pdf1($id1, $id3) {
        $file = KelasPerkuliahan::where('id_kelas_perkuliahan', $id1)->first();

        if ($file) {
            if ($id3 === '1') {
                $path = storage_path('app/' . $file->file_rps);
                return response()->file($path);
            } else if ($id3 === '2') {
                $path = storage_path('app/' . $file->file_rtm);
                return response()->file($path);
            } else if ($id3 === '3') {
                $path = storage_path('app/' . $file->file_kontrak_perkuliahan);
                return response()->file($path);
            } else {
                return response()->json(['error' => 'ID tipe file tidak valid'], 400);
            }
        }
        return response()->json(['error' => 'File tidak ditemukan'], 404);
    }


    public function bukti($id){
        $file = Monitoring::where('pertemuan',$id)->first();

        $path = storage_path('app/'. $file->bukti);

        return response()->file($path);
    }

    public function kelengkapan_dokumen($id){
        $data = DB::table('hasilverifikasi')->where('hasilverifikasi.id_hasilverifikasi','=',$id)
        ->join('kelasperkuliahan','kelasperkuliahan.id_kelasperkuliahan','=','hasilverifikasi.id_kelasperkuliahan')
        ->join('matakuliah','matakuliah.kode_matakuliah','=','kelasperkuliahan.kode_matakuliah')
        ->join('tahun_akademik','tahun_akademik.id_tahun_akademik','=','kelasperkuliahan.id_tahun_akademik')
        ->join('dosen','dosen.nip_dosen','=','kelasperkuliahan.nip_dosen')->get();

        $data1 = DetailHasilVerifikator::where('id_hasilverifikasi', $id)->with('jenis_kelengkapan_berkas','hasil_verifikasi.dosen_verifikator')->get();

        $gkm = User::where('status',2)->first();

        $ttd = HasilVerifikasi::where('id_hasilverifikasi',$id)->first();

        $berkas = BerkasDokumen::where('id_kelasperkuliahan',$ttd->id_kelasperkuliahan)->get();

        // echo $data;
        $pdf = PDF::loadView('Berkas.kelengkapan_berkas', compact('data','data1','gkm','ttd','berkas'))->setPaper('a4', 'potrait');

        // echo $berkas;
        return $pdf->stream();
        // return view('Berkas.kelengkapan_berkas', compact('data','data1','gkm','ttd'));
    }

    public function soal_uts($id){
        $data = DB::table('hasilverifikasi')->where('hasilverifikasi.id_hasilverifikasi','=',$id)
        ->join('kelasperkuliahan','kelasperkuliahan.id_kelasperkuliahan','=','hasilverifikasi.id_kelasperkuliahan')
        ->join('tahun_akademik','kelasperkuliahan.id_tahun_akademik','=','tahun_akademik.id_tahun_akademik')
        ->join('matakuliah','matakuliah.kode_matakuliah','=','kelasperkuliahan.kode_matakuliah')
        ->join('dosen','dosen.nip_dosen','=','kelasperkuliahan.nip_dosen')->get();

        $data1 = DetailHasilVerifikator::where('id_hasilverifikasi', $id)->with('jenis_kelengkapan_berkas','hasil_verifikasi.dosen_verifikator')->get();

        $gkm = User::where('status',2)->first();

        $ttd = HasilVerifikasi::where('id_hasilverifikasi',$id)->first();

        $berkas = BerkasDokumen::where('id_kelasperkuliahan',$ttd->id_kelasperkuliahan)->with('kategori_berkas')->get();

        $pdf = PDF::loadView('Berkas.soal_uts', compact('data','data1','gkm','ttd','berkas'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function soal_uas($id){

    }

    public function bap($id, $status){
        $data = DB::table('hasilverifikasi')->where([['hasilverifikasi.id_hasilverifikasi','=',$id],['hasilverifikasi.timeline_perkuliahan',$status]])
        ->join('kelasperkuliahan','kelasperkuliahan.id_kelasperkuliahan','=','hasilverifikasi.id_kelasperkuliahan')
        ->join('matakuliah','matakuliah.kode_matakuliah','=','kelasperkuliahan.kode_matakuliah')
        ->join('tahun_akademik','kelasperkuliahan.id_tahun_akademik','=','kelasperkuliahan.id_tahun_akademik')
        ->join('dosen','dosen.nip_dosen','=','kelasperkuliahan.nip_dosen')->get();

        $data1 = Monitoring::where('id_hasilverifikasi', $id)->get();

        $gkm = User::where('status',2)->first();

        $ttd = HasilVerifikasi::where('id_hasilverifikasi',$id)->first();

        // $berkas = BerkasDokumen::where('id_kelas_perkuliahan',$ttd->id_kelas_perkuliahan)->get();

        $pdf = PDF::loadView('Berkas.cetak_bap', compact('data','data1','gkm','ttd'))->setPaper('a4', 'potrait');

        return $pdf->stream();
        // return view('Berkas.kelengkapan_berkas', compact('data','data1','gkm','ttd'));
    }
}
