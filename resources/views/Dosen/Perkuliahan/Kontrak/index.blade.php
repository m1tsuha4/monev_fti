@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kontrak Perkuliahan</h1>
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
                        </div>
                        <div class="col-md-1 text-right">
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                            <div>:</div>
                        </div>
                        <div class="col-md-4">
                            <div>{{$matakuliah[0]->kelas_perkuliahan->id}}</div>
                            <div>{{$matakuliah[0]->kelas_perkuliahan->matakuliah->nama_matakuliah}}</div>
                            <div>{{$matakuliah[0]->kelas_perkuliahan->matakuliah->kategori_matakuliah}}</div>
                            <div>{{$matakuliah[0]->kelas_perkuliahan->matakuliah->kuota}}</div>
                            <div>{{$matakuliah[0]->kelas_perkuliahan->matakuliah->semester}} / {{$matakuliah[0]->kelas_perkuliahan->matakuliah->sks}}</div>
                            <div>{{$matakuliah[0]->kelas_perkuliahan->tahun_akademik}}</div>
                            <div>{{$matakuliah[0]->kelas_perkuliahan->kurikulum}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-secondary">Isi Kontrak Perkuliahan</h6>
                        </div>
                        @if($matakuliah[0]->status != 2)
                        <div class="col-md-6 text-right">
                            <a href="{{url('/dosen/kelas-perkuliahan/detail/kontrak/edit')}}/{{$matakuliah[0]->id}}" id="add" class="btn btn-secondary btn-sm">
                                <!-- <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span> -->
                                <span class="text"><i class="fa fa-plus"></i> Edit Kontrak Perkuliahan</span>
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body border-bottom-secondary">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Uraian</th>
                                        <th>Keterangan**</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size:13px;">
                                <?php
                                    $no = 1;
                                ?>
                                  @forelse ($kontrak as $b)
                                  <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$b->uraian}}</td>
                                        <td>{!! $b->keterangan !!}</td>
                                    </tr>
                                  @empty
                                <tr>
                                    <td colspan=3 class="text-center">Belum Ada Data</td>
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
</div>

@endsection