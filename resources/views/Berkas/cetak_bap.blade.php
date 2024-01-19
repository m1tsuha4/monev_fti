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
                <b>&nbsp;&nbsp;&nbsp;DEPARTEMEN SISTEM INFORMASI</b>
            </td>
        </tr>
        <tr style="font-size:13px">
            <td style="border-style: solid;background-color:silver;text-align: center;" colspan=6>
                @if($data[0]->timeline_perkuliahan == 1)
                <b>Berita Acara Perkuliahan (Sebelum UTS)</b>
                @else
                <b>Berita Acara Perkuliahan (Setelah UTS)</b>
                @endif
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
            <td style='width:10%;border-style: solid;padding-left:4px'><b>Tahun Akademik</b></td>
            <td colspan="5" style='border-style: solid;padding-top:0px'><b>&nbsp;&nbsp;&nbsp;{{$data[0]->tahun}}</b></td>
        </tr>
        <tr style="font-size:13px">
            <td style="border-style: solid;background-color:silver;text-align: center;" colspan=6>
                <b>PETUNJUK</b>
            </td>
        </tr>
        <tr style="font-size:10px;text-align: left;">
            <td colspan="6" style='width:100%;border-style: solid;padding-left:8px'>
                1. Dosen mengisi kolom realisasi RPS kemudian di paraf oleh dosen dan perwakilan mahasiswa <br>
                2. GKM (Gugus Kendali Mutu) jurusan menulis temuan ketidaksesuaian pada kolom yang disediakan dan di paragraf<br>
                3. Apabila ditemukan ketidaksesuaian, GKM mengisi kolom verifikasi dan tindakan perbaikan<br>
                4. Monitoring dan verifikasi dilakukan minimal 2 (dua) kali dalam 1 (satu) semester (Sebelum UTS dan sebelum UAS)<br>
            </td>
        </tr>
    </table>

    <table style="width: 100%">
        <?php $no=1 ?>
        <tr style="font-size:13px">
            <td style="border-style: solid;background-color:silver;text-align: center;">
                <b>Pertemuan ke-</b>
            </td>
            <td style="border-style: solid;background-color:silver;text-align: center;">
                <b>Waktu Pelaksanaan</b>
            </td>
            <td style="border-style: solid;background-color:silver;text-align: center;">
                <b>Rencana Pembelajaran Semester</b>
            </td>
            <td style="border-style: solid;background-color:silver;text-align: center;">
                <b>Realisasi Pembelajaran Semester</b>
            </td>
            <td style="border-style: solid;background-color:silver;text-align: center;">
                <b>Assesmen (Tugas/Kuis)</b>
            </td>
            <td style="border-style: solid;background-color:silver;text-align: center;">
                <b>Jumlah MHS</b>
            </td>
        </tr>
        <?php $no=1?>
        @foreach($data1 as $d)
        <tr style="font-size:10px;text-align:center;">
            <td style="border-style: solid;">{{$no++}}</td>
            <td style="border-style: solid;text-align: left;">
            Hari: {{date('l', strtotime ($d->tanggal))}}<br>
            Tanggal: {{$d->tanggal}}<br>
            Jam: {{$d->jam_mulai}} - {{$d->jam_selesai}}
            </td>
            <td style="border-style: solid;">{{$d->rencana_pembelajaran}}</td>
            <td style="border-style: solid;">{{$d->realisasi_pembelajaran}}</td>
            <td style="border-style: solid;">{{$d->assesment}}</td>
            <td style="border-style: solid;">{{$d->jumlah_mahasiswa_hadir}} Orang</td>
        </tr>
        @endforeach
        <tr style="font-size:13px">
            <td style="border-style: solid;background-color:silver;text-align: center;" colspan=6>
                <b>VERIFIKASI GKM</b>
            </td>
        </tr>
        <tr style="font-size:11px">
            <td style="width:30%;border-style: solid;text-align: left;padding-left:5px" colspan=2>
                <span>Tanggal:</span><br>
                <span>Dosen Verifikator:</span>
                <div>
                    <img src="{{ public_path('storage/'.$data[0]->tanda_tangan_verifikator) }}" width="100px">
                </div>
                <span>( {{$data[0]->nama_verifikator}} )</span><br>
                <span>Nip. {{$data[0]->nip_verifikator}}</span>
            </td>
            <td style="width:30%;border-style: solid;text-align: center;" colspan=2>
                @if($data[0]->catatan == null || $data[0]->catatan = "")
                    <span> - </span>
                @else
                    <span>{{$data[0]->catatan}}</span>
                @endif
            </td>
            <td style="width:30%;border-style: solid;text-align: right;padding-right:5px" colspan=2>
                <span>Mengetahui</span><br>
                <span>Ketua GKM</span>
                <div>
                    <img src="{{ public_path('storage/'.$data[0]->tanda_tangan_gkm) }}" width="100px">
                </div>
                <span>( {{$gkm->nama_dosen}} )</span><br>
                <span>Nip. {{$gkm->nip_dosen}}</span>
            </td>
        </tr>

    </table>
</body>
</html>
