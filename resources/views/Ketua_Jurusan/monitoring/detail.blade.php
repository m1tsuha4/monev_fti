@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Monitoring Kelas Perkuliahan</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-secondary">Info Kelas</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-secondary">
                    <div class="row">
                        <div class="col-md-3">
                            <div>Kode Kelas</div>
                            <div>Matakuliah</div>
                            <div>Kelas</div>
                            <div>Kuota</div>
                            <div>Semester / Sks</div>
                            <div>Tahun Akademik</div>
                            <div>Kurikulum</div>
                            <div>Dosen Pengampu</div>
                            <div>Dosen Verifikator</div><br>
                            <div>BAP (Sebelum UTS)</div><br>
                            <div>BAP (Setelah UTS)</div>
                        </div>
                        <div class="col-md-1 text-right">
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div><br>
                            <div>:</div><br>
                            <div>:</div>
                        </div>
                        <div class="col-md-8 text-left">
                            <div>{{$data[0]->kode_matakuliah}}</div>
                            <div>{{$data[0]->nama_matakuliah}}</div>
                            <div>{{$data[0]->kategori_matakuliah}}</div>
                            <div>{{$data[0]->estimasi_mahasiswa}}</div>
                            <div>{{$data[0]->semester}} / {{$data[0]->jumlah_sks}}</div>
                            <div>{{$data[0]->tahun}}</div>
                            <div>{{$data[0]->tahun_kurikulum}}</div>
                            <div>{{$data[0]->nama_pengampu}}</div>
                            <div>{{$data[0]->nama_verifikator}}</div><br>
                            @foreach($data as $daa)
                                @if($daa->timeline_perkuliahan == 1 and $daa->status_kelas_perkuliahan == 2)
                                <div><button id="bap" data-id="" class="btn btn-sm btn-info"><i class="fa fa-file"></i> Lihat</button></div>
                                @else
                                <div><button class="btn btn-sm btn-secondary">Tidak Tersedia</button></div>
                                @endif
                            @endforeach
                            <br>
                            @foreach($data as $daa1)
                                @if($daa1->timeline_perkuliahan == 3 and $daa1->status_kelas_perkuliahan == 2)
                                <div><button id="bap1" data-id="" class="btn btn-sm btn-info"><i class="fa fa-file"></i> Lihat</button></div>
                                @else
                                <div><button class="btn btn-sm btn-secondary">Tidak Tersedia</button></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-secondary">Info Kegiatan Kelas</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-secondary">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Materi</th>
                                    <th>Jumlah Mahasiswa</th>
                                    <th>Mulai</th>
                                    <th>Selesai</th>
                                    <th>Bukti</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;">
                            <?php
                                $no = 1;
                            ?>
                            @forelse($data_monitoring as $da)

                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$da->tanggal}}</td>
                                        <td>{{$da->materi}}</td>
                                        <td>{{$da->jumlah_mahasiswa_hadir}} Orang</td>
                                        <td>{{$da->jam_mulai}}</td>
                                        <td>{{$da->jam_selesai}}</td>
                                        <td class="text-center">
                                            <a id="pdf" href="#" data-id="{{$da->id_kelas_perkuliahan}}"><i class="fa fa-file"></i></a>
                                        </td>
                                    </tr>

                            @empty
                                <tr>
                                    Tidak Ada Data
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
$(document).ready( function () {
$(document).on('click', '#pdf', function() {
    var id = $(this).data('id');
    window.open("{{ url('bukti') }}/"+id);
});

$(document).on('click', '#bap', function() {
    var id = $(this).data('id');
    window.open("{{ url('bap') }}/"+id+"/"+1);
});
$(document).on('click', '#bap1', function() {
    var id = $(this).data('id');
    window.open("{{ url('bap') }}/"+id+"/"+3);
});
});
</script>
@endsection
