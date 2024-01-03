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

    public function index()
    {
        return view('Ketua_Jurusan.master.kategori_berkas');
    }

    public function data()
    {
        $kategoriberkas = KategoriBerkas::get();
        return response()->json(['data' => $kategoriberkas]);
    }

    public function create(Request $request)
    {
        $data = KategoriBerkas::orderBy('id_kategori_berkas', 'DESC')->first();
        $id;

        if ($data == null) {
            $id = "B01";
        } else {
            $newId = substr($data->id_kategori_berkas, 2, 1);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1) {
                $id = "B0" . $tambah;
            } else if (strlen($tambah) == 2) {
                $id = "B" . $tambah;
            }
        }

        KategoriBerkas::create([
            'id_kategori_berkas' => $id,
            'nama_berkas' => $request->nama_berkas,
            'kategori_berkas' => $request->kategori,
        ]);

        return redirect()->route('jurusan.kategori_berkas')->with('success', 'Data Berhasil Di Simpan');
    }

    public function edit($id)
    {
        $kategoriberkas = KategoriBerkas::where('id_kategori_berkas', $id)->get();
        return $kategoriberkas->toJson();
    }

    public function update(Request $request, $id)
    {
        $kategoriberkas = KategoriBerkas::where('id_kategori_berkas', $id)->first();

        $kategoriberkas->nama_berkas  = $request->nama_berkas;
        $kategoriberkas->kategori_berkas  = $request->kategori_berkas;

        $kategoriberkas->save();

        return redirect()->route('jurusan.kategori_berkas')->with('success', 'Data Berhasil Di Ubah');
    }

    public function delete($id)
    {
        KategoriBerkas::where('id_kategori_berkas', $id)->delete();
    }

    // End Kategori Berkas Master

    // Kategori Penilaian Soal Master

    public function penilaian_soal_index()
    {
        return view('Ketua_Jurusan.master.penilaian_soal');
    }

    public function penilaian_soal_data()
    {
        // $JenisKelengkapanDokumen = JenisKelengkapanDokumen::get();
        // // $JenisKelengkapanSoal = JenisSoalUjian::get();
        // return response()->json([
        //     'data_dokumen' => $JenisKelengkapanDokumen,
        //     // 'data_soal' => $JenisKelengkapanSoal,
        // ]);
        $JenisSoalUjian = JenisSoalUjian::get();
        return response()->json(['data' => $JenisSoalUjian]);
    }

    public function penilaian_soal_create(Request $request)
    {
        $data_soal = JenisSoalUjian::orderBy('id_form_validasisoal', 'DESC')->first();
        // dd($test);

        if ($data_soal == null) {
            $id = "S01";
        } else {
            $newId = substr($data_soal->id_form_validasisoal, 1, 2);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1) {
                $id = "S0" . $tambah;
            } else if (strlen($tambah) == 2) {
                $id = "S" . $tambah;
            }
        }

        JenisSoalUjian::create([
            'id_form_validasisoal' => $id,
            'kriteria_penilaian' => $request->kriteria_penilaian,
            'point_penilaian' => $request->point_penilaian,
        ]);

        // $id;



        return redirect()->route('jurusan.kategori_penilaian_soal')->with('success', 'Data Berhasil Di Simpan');
    }

    public function penilaian_soal_edit($id)
    {

        $JenisSoalUjian = JenisSoalUjian::where('id_form_validasisoal', $id)->get();

        return $JenisSoalUjian->toJson();
    }

    public function penilaian_soal_update(Request $request, $id)
    {
        $JenisSoalUjian = JenisSoalUjian::where('id_form_validasisoal', $id)->first();

        $JenisSoalUjian->kriteria_penilaian  = $request->kriteria_penilaian;
        $JenisSoalUjian->point_penilaian = $request->point_penilaian;

        $JenisSoalUjian->save();

        return redirect()->route('jurusan.kategori_penilaian_soal')->with('success', 'Data Berhasil Di Ubah');
    }

    public function penilaian_soal_delete($id)
    {
        JenisSoalUjian::where('id_form_validasisoal', $id)->delete();
    }

    // End Kategori Penilaian Master

    // Kategori Penilaian Master

    public function penilaian_index()
    {
        return view('Ketua_Jurusan.master.penilaian');
    }

    public function penilaian_data()
    {

        $JenisKelengkapanDokumen = JenisKelengkapanDokumen::get();
        return response()->json(['data' => $JenisKelengkapanDokumen]);
    }

    public function penilaian_create(Request $request)
    {
        $data = JenisKelengkapanDokumen::orderBy('id_jenis_kelengkapan_dokumen', 'DESC')->first();

        // dd($test);

        if ($data == null) {
            $id = "P01";
        } else {
            $newId = substr($data->id_jenis_kelengkapan_dokumen, 1, 2);
            $tambah = (int)$newId + 1;
            if (strlen($tambah) == 1) {
                $id = "P0" . $tambah;
            } else if (strlen($tambah) == 2) {
                $id = "P" . $tambah;
            }
        }

        JenisKelengkapanDokumen::create([
            'id_jenis_kelengkapan_dokumen' => $id,
            'point_penilaian_kelengkapan_dokumen' => $request->kelengkapan_dokumen,
            'tipe_penilaian' => $request->tipe_penilaian,
        ]);


        return redirect()->route('jurusan.kategori_penilaian_dokumen')->with('success', 'Data Berhasil Di Simpan');
    }

    public function penilaian_edit($id)
    {

        $JenisKelengkapanDokumen = JenisKelengkapanDokumen::where('id_jenis_kelengkapan_dokumen', $id)->get();

        return $JenisKelengkapanDokumen->toJson();
    }

    public function penilaian_update(Request $request, $id)
    {
        $JenisKelengkapanDokumen = JenisKelengkapanDokumen::where('id_jenis_kelengkapan_dokumen', $id)->first();

        $JenisKelengkapanDokumen->point_penilaian_kelengkapan_dokumen  = $request->kelengkapan_dokumen;
        $JenisKelengkapanDokumen->tipe_penilaian  = $request->tipe_penilaian;

        $JenisKelengkapanDokumen->save();

        return redirect()->route('jurusan.kategori_penilaian_dokumen')->with('success', 'Data Berhasil Di Ubah');
    }

    public function penilaian_delete($id)
    {
        JenisKelengkapanDokumen::where('id_jenis_kelengkapan_dokumen', $id)->delete();
    }

    // End Kategori Penilaian Soal Master

    // Dosen Pengampu
    public function detail_kontrak($id)
    {
        $matakuliah = BerkasDokumen::where('id_berkas', $id)->with('kelas_perkuliahan.matakuliah')->get();
        $kontrak = KontrakPerkuliahan::where('berkas_id', $id)->get();

        return view('Dosen.Perkuliahan.Kontrak.index', compact('kontrak', 'matakuliah'));
    }

    public function create_kontrak($id)
    {
        $data = KelasPerkuliahan::where('id', $id)->with('matakuliah')->first();
        return view('Dosen.Perkuliahan.Kontrak.create', compact('id', 'data'));
    }

    public function store_kontrak(Request $request)
    {
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

    public function edit_kontrak($id)
    {
        $data = KontrakPerkuliahan::where('berkas_id', $id)->get();

        return view('Dosen.Perkuliahan.Kontrak.edit', compact('data'));
    }

    public function update_kontrak(Request $request)
    {
        KontrakPerkuliahan::where('id', $request->id[0])->update([
            'keterangan' => $request->summary_ckeditor[0],
        ]);

        KontrakPerkuliahan::where('id', $request->id[1])->update([
            'keterangan' => $request->summary_ckeditor[1],
        ]);

        KontrakPerkuliahan::where('id', $request->id[2])->update([
            'keterangan' => $request->summary_ckeditor[2],
        ]);

        KontrakPerkuliahan::where('id', $request->id[3])->update([
            'keterangan' => $request->summary_ckeditor[3],
        ]);

        return back();
    }

    public function upload_berkas(Request $request, $id)
    {
        $now = Carbon::now();
        $data_kelas = KelasPerkuliahan::where('id_kelas_perkuliahan', $request->id_kelas)->first();
        if ($id == 1) {
            $file1 = $request->file('rps');
            $file2 = $request->file('rtm');
            $file3 = $request->file('kontrak');
            // $file4 = $request->file('bap');

            $this->deleteFileIfExists($data_kelas->file_rps);
            $this->deleteFileIfExists($data_kelas->file_rtm);
            $this->deleteFileIfExists($data_kelas->file_kontrak_perkuliahan);

            if ($file1 != null) {
                if ($file1->isValid()) {
                    $path = $file1->store('public/dokumen');
                    $data_kelas->file_rps = $path;
                    $data_kelas->save();
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
        } else {

            $file = $request->file('berkas');

            $data_soal = BerkasDokumen::where('id_kelas_perkuliahan', $request->id_kelas1)->where('nama_soal', $request->nama_soal)->first();
            // dd($data_soal );
            if (isset($data_soal)) {
                $this->deleteFileIfExists($data_soal->file_soal);
            }

            if ($file != null) {
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

    private function deleteFileIfExists($path)
    {
        if ($path && Storage::exists($path)) {
            Storage::delete($path);
        }
    }

    public function edit_berkas($id, $id1)
    {
        $BerkasDokumen = BerkasDokumen::where([['id_kelasperkuliahan', $id1], ['id_kategori_berkas', $id]])->get();
        return $BerkasDokumen->toJson();
    }

    public function update_berkas(Request $request, $id)
    {
        $now = Carbon::now();
        $file = $request->file('berkas');
        if ($file != null) {
            if ($file->isValid()) {
                $path = $file->store('public/dokumen');
                BerkasDokumen::where([['id_kelasperkuliahan', $id], ['id_kategori_berkas', $request->kategori_berkas]])->update([
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

    public function verifikator_kontrak($id)
    {
        $matakuliah = BerkasDokumen::where('id_berkas', $id)->with('kelas_perkuliahan.matakuliah')->get();
        $kontrak = KontrakPerkuliahan::where('berkas_id', $id)->get();

        return view('Dosen.Verifikator.kontrak', compact('kontrak', 'matakuliah'));
    }

    public function pdf($id, $id1)
    {
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
        $file = BerkasDokumen::where([['id_kelas_perkuliahan', $id1], ['id_soal', $id]])->first();

        $path = storage_path('app/' . $file->file_soal);

        return response()->file($path);
    }
    public function pdf1($id1, $id3)
    {
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


    public function bukti($id)
    {
        $file = Monitoring::where('pertemuan', $id)->first();

        $path = storage_path('app/' . $file->bukti);

        return response()->file($path);
    }

    public function kelengkapan_dokumen($id)
    {
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

        // $data = DB::table('hasilverifikasi')->where('hasilverifikasi.id_hasilverifikasi','=',$id)
        // ->join('kelasperkuliahan','kelasperkuliahan.id_kelasperkuliahan','=','hasilverifikasi.id_kelasperkuliahan')
        // ->join('matakuliah','matakuliah.kode_matakuliah','=','kelasperkuliahan.kode_matakuliah')
        // ->join('tahun_akademik','tahun_akademik.id_tahun_akademik','=','kelasperkuliahan.id_tahun_akademik')
        // ->join('dosen','dosen.nip_dosen','=','kelasperkuliahan.nip_dosen')->get();

        $data1 = DB::table('tipe_penilaian_dokumen')
            ->join('form_kelengkapan_dokumen', 'form_kelengkapan_dokumen.id_jenis_kelengkapan_dokumen', '=', 'tipe_penilaian_dokumen.id_jenis_kelengkapan_dokumen')
            ->where('id_kelas_perkuliahan', $id)->get();

        $gkm = User::where('status', 2)->first();

        // $ttd = HasilVerifikasi::where('id_hasilverifikasi',$id)->first();

        // $berkas = BerkasDokumen::where('id_kelasperkuliahan',$ttd->id_kelasperkuliahan)->get();

        // echo $data;
        $pdf = PDF::loadView('Berkas.kelengkapan_berkas', compact('data', 'data1', 'gkm'))->setPaper('a4', 'potrait');

        // echo $berkas;
        return $pdf->stream();
        // return view('Berkas.kelengkapan_berkas', compact('data','data1','gkm','ttd'));
    }

    public function soal_uts($id)
    {

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

        $data1 = DB::table('tipe_penilaian_soal')
            ->join('form_validasi_soalujian', 'tipe_penilaian_soal.id_form_validasisoal', '=', 'form_validasi_soalujian.id_form_validasisoal')
            ->join('berkas_soal', 'berkas_soal.id_soal', '=', 'tipe_penilaian_soal.id_soal')
            ->where('id_kelas_perkuliahan', '=', $id)
            ->where('nama_soal', '=', 'UTS')
            ->get();

        // $data1 = DetailHasilVerifikator::where('id_hasilverifikasi', $id)->with('jenis_kelengkapan_berkas','hasil_verifikasi.dosen_verifikator')->get();

        $gkm = User::where('status', 2)->first();

        // $ttd = HasilVerifikasi::where('id_hasilverifikasi',$id)->first();

        // $berkas = BerkasDokumen::where('id_kelasperkuliahan',$ttd->id_kelasperkuliahan)->with('kategori_berkas')->get();

        $pdf = PDF::loadView('Berkas.soal_uts', compact('data', 'data1', 'gkm'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function soal_uas($id)
    {
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

        $data1 = DB::table('tipe_penilaian_soal')
            ->join('form_validasi_soalujian', 'tipe_penilaian_soal.id_form_validasisoal', '=', 'form_validasi_soalujian.id_form_validasisoal')
            ->join('berkas_soal', 'berkas_soal.id_soal', '=', 'tipe_penilaian_soal.id_soal')
            ->where('id_kelas_perkuliahan', '=', $id)
            ->where('nama_soal', '=', 'UAS')
            ->get();

        // $data1 = DetailHasilVerifikator::where('id_hasilverifikasi', $id)->with('jenis_kelengkapan_berkas','hasil_verifikasi.dosen_verifikator')->get();

        $gkm = User::where('status', 2)->first();

        // $ttd = HasilVerifikasi::where('id_hasilverifikasi',$id)->first();

        // $berkas = BerkasDokumen::where('id_kelasperkuliahan',$ttd->id_kelasperkuliahan)->with('kategori_berkas')->get();

        $pdf = PDF::loadView('Berkas.soal_uas', compact('data', 'data1', 'gkm'))->setPaper('a4', 'potrait');

        return $pdf->stream();
    }

    public function bap($id, $status)
    {
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
            
        $gkm = User::where('status', 2)->first();

        if ($status == 1) {
            $data1 = Monitoring::where('id_kelas_perkuliahan', $id)
                ->whereBetween('pertemuan', [1, 8])
                ->get();
            $pdf = PDF::loadView('Berkas.cetak_bap', compact('data', 'data1', 'gkm'))->setPaper('a4', 'potrait');

            return $pdf->stream();
        } elseif ($status == 3) {
            $data1 = Monitoring::where('id_kelas_perkuliahan', $id)
                ->whereBetween('pertemuan', [9, 16])
                ->get();
            $pdf = PDF::loadView('Berkas.cetak_bap', compact('data', 'data1', 'gkm'))->setPaper('a4', 'potrait');

            return $pdf->stream();
        }
    }
}
