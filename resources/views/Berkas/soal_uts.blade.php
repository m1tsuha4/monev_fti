<!doctype html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    .div-class {
        position: relative;
    }

    .inner-image {
        position: absolute;
    }
    
</style>
</head>
<body>
    <table style="width: 100%">
        <tr>
            <td style='width:10%;border-style: solid;'><img src="{{public_path('Logo/logo_unand.png')}}" width="70" style="padding-left:18px;padding-right:18px;"></td>
            <td colspan="5" style='font-size:12px;border-style: solid;padding-top:0px'>
                <span>&nbsp;&nbsp;&nbsp;UNIVERSITAS ANDALAS</span><br>
                <b>&nbsp;&nbsp;&nbsp;FAKULTAS TEKNOLOGI INFORMASI</b><br>
                <b>&nbsp;&nbsp;&nbsp;JURUSAN SISTEM INFORMASI</b>
            </td>
        </tr>
        <tr style="font-size:10px">
            <td style='width:10%;border-style: solid;padding-left:4px'><b>Mata Kuliah</b></td>
            <td colspan="5" style='border-style: solid;padding-top:0px'><b>&nbsp;&nbsp;&nbsp;{{$data[0]->nama_matakuliah}}</b></td>
        </tr>
        <tr style="font-size:10px">
            <td style='width:10%;border-style: solid;padding-left:4px'><b>Kode MK</b></td>
            <td style='width:40%;border-style: solid;padding-left:4px'><b>&nbsp;&nbsp;{{$data[0]->kode_matakuliah}}</b></td>
            <td style='width:7%;border-style: solid;padding-left:4px'><b>SKS</b></td>
            <td style='width:20%;border-style: solid;padding-left:4px'><b>&nbsp;&nbsp;&nbsp;{{$data[0]->jumlah_sks}}</b></td>
            <td style='width:13%;border-style: solid;padding-left:4px'><b>Semester</b></td>
            <td style='width:20%;border-style: solid;padding-left:4px'><b>&nbsp;&nbsp;&nbsp;{{$data[0]->semester}}</b></td>
        </tr>
        <tr style="font-size:10px">
            <td style='width:10%;border-style: solid;padding-left:4px'><b>Dosen Pengampu</b></td>
            <td colspan="5" style='border-style: solid;padding-top:0px'><b>&nbsp;&nbsp;&nbsp;{{$data[0]->nama_pengampu}}</b></td>
        </tr>
        <tr style="font-size:10px">
            <td style='width:10%;border-style: solid;padding-left:4px'><b>Periode Ujian</b></td>
            <td style='width:10%;border-style: solid;padding-left:4px'><b>&nbsp;&nbsp;
                UTS
            </b></td>
            <td colspan="2" style='width:40%;border-style: solid;padding-left:4px'><b>Tahun Akademik</b></td>
            <td colspan="2" style='border-style: solid;padding-top:0px'><b>&nbsp;&nbsp;&nbsp;{{$data[0]->tahun}}</b></td>
        </tr>
        <tr style="font-size:13px">
            <td style="border-style: solid;background-color:silver;text-align: center;" colspan=6>
                <b>VALIDASI SOAL UJIAN</b>
            </td>            
        </tr>
        <tr style="font-size:12px;text-align: center;">
            <th style="border-style: solid;">No.</th>
            <th style="border-style: solid;" colspan="2">Kelengkapan Dokumen</th>
            <th style="border-style: solid;">Penilaian</th>
            <th style="border-style: solid;" colspan="2">Keterangan</th>
        </tr>
        <tr style="font-size:13px">
            <td style="border-style: solid;" colspan=6>
                <b>&nbsp;&nbsp;&nbsp;Format Penulisan Soal</b>
            </td>            
        </tr>
        <?php $no=1 ?>
        @foreach($data1 as $d)
            @if($d->kriteria_penilaian == "Format Penulisan Soal")
            <tr style="font-size:11px;text-align: center;">
                <td style="border-style: solid;">{{$no++}}</td>
                <td style="border-style: solid;text-align: left;" colspan="2">{{$d->point_penilaian}}</td>
                <td style="border-style: solid;">{{$d->penilaian_soal}}</td>
                <td style="border-style: solid;" colspan="2">{{$d->keterangan}}</td>
            </tr>
            @endif
        @endforeach

        <tr style="font-size:13px">
            <td style="border-style: solid;" colspan=6>
                <b>&nbsp;&nbsp;&nbsp;Materi Soal</b>
            </td>            
        </tr>
        
        <?php $no=1?>
        @foreach($data1 as $d)
            @if($d->kriteria_penilaian == "Materi Soal")
            <tr style="font-size:11px;text-align: center;">
                <td style="border-style: solid;">{{$no++}}</td>
                <td style="border-style: solid;text-align: left;" colspan="2">{{$d->point_penilaian}}</td>
                <td style="border-style: solid;">{{$d->penilaian_soal}}</td>
                <td style="border-style: solid;" colspan="2">{{$d->keterangan}}</td>
            </tr>
            @endif
        @endforeach
        <tr style="font-size:13px">
            <td style="border-style: solid;background-color:silver;text-align: center;" colspan=6>
                <b>CATATAN HASIL Validasi</b><br>
                <b>DAN SARAN PERBAIKAN</b>
            </td>            
        </tr>
        <tr style="font-size:13px">
            <td style="border-style: solid;text-align: center;" colspan=6>
                @if($data[0]->catatan == null || $data[0]->catatan = "")
                    <span> - </span>
                @else
                    <span>{{$data[0]->catatan}}</span>
                @endif
            </td>            
        </tr>
        <tr style="font-size:11px">
            <td style="border-style: solid;text-align: left;padding-left:5px" colspan=3>
                <span>Tanggal:</span><br>
                <span>Dosen Verifikator:</span>
                <div>
                    <img src="{{ public_path($data[0]->tanda_tangan_verifikator) }}" width="100px">
                </div>
                <span>( {{$data[0]->nama_verifikator}} )</span><br>
                <span>Nip. {{$data[0]->nip_verifikator}}</span>
            </td>
            <td style="border-style: solid;text-align: right;padding-right:5px" colspan=3>
                <span>Mengetahui</span><br>
                <span>Ketua GKM</span>
                <div>
                    <img src="{{ public_path($data[0]->tanda_tangan_gkm) }}" width="100px">
                </div>
                <span>( {{$gkm->nama_dosen}} )</span><br>
                <span>Nip. {{$gkm->nip_dosen}}</span>
            </td>
        </tr>

    </table>
</body>
</html>