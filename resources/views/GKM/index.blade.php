@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Verifikasi Page</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-secondary">Table Data</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-secondary">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Matakuliah</th>
                                    <th>Dosen Verifikator</th>
                                    <th>Kurikulum</th>
                                    <th>Tanggal</th>
                                    <th>Tipe</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;">
                            <?php $no = 1; ?>
                            @forelse($data as $d)
                            @if($d->kelas_perkuliahan->matakuliah->kode_prodi == $id)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$d->kelas_perkuliahan->tahun_akademik->tahun}}</td>
                                <td>{{$d->kelas_perkuliahan->matakuliah->nama_matakuliah}}</td>
                                <td>{{$d->dosen_verifikator->nama}}</td>
                                <td>{{$d->kelas_perkuliahan->kurikulum}}</td>
                                <td>{{$d->tanggal_verifikasi}}</td>
                                <td>
                                    @if($d->timeline_perkuliahan == 1)
                                    Perkuliahan
                                    @elseif($d->timeline_perkuliahan == 2)
                                    Soal Ujian Tengah Semester
                                    @else
                                    Soal Ujian Akhir Semester
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($d->tanda_tangan_gkm == null)
                                    <span class="badge badge-warning">Menunggu</span>     
                                    @else
                                    <span class="badge badge-success">Selesai</span>                                         
                                    @endif
                                </td>
                                <td>
                                    @if($d->tanda_tangan_gkm == null)
                                    <a style="text-decoration:none" href="{{url('/gkm/monev/detail')}}/{{$d->id_hasilverifikasi}}" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
                                    @else
                                    <a style="text-decoration:none" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>                                  
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr class="text-center">
                                <td colspan="8">Tidak Ada Data</td>
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


    $(document).on('click', '#detail', function() {
        var id = $(this).data('id');
        window.location.href = "{{ url('dosen/kelas-perkuliahan/detail/') }}/"+id;
    });

    $(document).on('click', '#detail1', function() {
        var id = $(this).data('id');
        window.location.href = "{{ url('dosen/kelas-perkuliahan/monitoring/') }}/"+id;
    });

    });
</script>
@endsection