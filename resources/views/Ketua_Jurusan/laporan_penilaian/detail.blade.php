@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Evaluasi Kinerja</h1>
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
                            <div>{{$data[0]->nama_verifikator}}</div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <b>Berkas Kelengkapan Dokumen Perkuliahan Dan Validasi Soal Ujian</b><br><br>
                            @foreach($data as $d)
                                @if($d->status_kelas_perkuliahan == 2)
                                    <!-- @if($d->timeline_perkuliahan == 1)
                                        <button class="btn btn-sm btn-info" id="berkas" data-id="{{$d->id_kelas_perkuliahan}}"><i class="fa fa-file"></i> Kelengkapan Dokumen Perkuliahan</button>
                                    @elseif($d->timeline_perkuliahan == 2)
                                        <button class="btn btn-sm btn-info" id="uts" data-id=""><i class="fa fa-file"></i> Soal Ujian Tengah Semester</button>
                                    @elseif($d->timeline_perkuliahan == 3)
                                        <button class="btn btn-sm btn-info" id="uas" data-id=}"><i class="fa fa-file"></i> Soal Ujian Akhir Semester</button>
                                    @endif -->
                                    <button class="btn btn-sm btn-info" id="berkas" data-id="{{$d->id_kelas_perkuliahan}}"><i class="fa fa-file"></i> Kelengkapan Dokumen Perkuliahan</button>
                                    @if(isset($data_uts))
                                    <button class="btn btn-sm btn-info" id="uts" data-id="{{$d->id_kelas_perkuliahan}}"><i class="fa fa-file"></i> Soal Ujian Tengah Semester</button>
                                    @endif
                                    @if(isset($data_uas))
                                    <button class="btn btn-sm btn-info" id="uas" data-id="{{$d->id_kelas_perkuliahan}}"><i class="fa fa-file"></i> Soal Ujian Akhir Semester</button>
                                    @endif
                                @endif
                            @endforeach
                            <!-- <a id="pdf" href="#" data-id=""><i class="fa fa-file"></i></a> -->
                        </div>
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
    $(document).on('click', '#berkas', function() {
        var id = $(this).data('id');
        window.open("{{ url('kelengkapan-berkas') }}/"+id);
    });

    $(document).on('click', '#bap', function() {
        var id = $(this).data('id');
        window.open("{{ url('bap') }}/"+id);
    });

    $(document).on('click', '#uts', function() {
        var id = $(this).data('id');
        window.open("{{ url('soal-uts') }}/"+id);
    });

    $(document).on('click', '#uas', function() {
        var id = $(this).data('id');
        window.open("{{ url('soal-uas') }}/"+id);
    });
});
</script>
@endsection
