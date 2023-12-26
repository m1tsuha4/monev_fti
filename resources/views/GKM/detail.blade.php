@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Info Data Detail Verifikasi Page</h1>
    </div>

     <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-secondary">Info Kelas Perkuliahan</h6>
                </div>

                <div class="card-body border-bottom-secondary">
                    <div class="row">
                        <div class="col-md-2">
                            <div>Matakuliah</div>
                            <div>Dosen Pengampu</div>
                            <div>Dosen Verifikator</div>
                            <div>Tahun Akademik</div>
                            <div>Kurikulum</div>
                            <div>Jenis Verifikasi</div>
                            <div>Tanggal Diperiksa</div>
                            @if($data[0]->tanda_tangan_gkm == null)
                            <button id="verifikasi" class="mt-4 btn btn-sm btn-success"> Verifikasi </button>
                            @else
                            <button class="mt-4 btn btn-sm btn-secondary"> Selesai </button>
                            @endif
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
                        <div class="col-md-9">
                            <div>{{$data[0]->nama_matakuliah}}</div>
                            <div>{{$data[0]->nama_pengampu}}</div>
                            <div>{{$data[0]->dosen_verifikator}}</div>
                            <div>{{$data[0]->tahun}} / Semester {{$data[0]->semester}}</div>
                            <div>{{$data[0]->tahun_kurikulum}}</div>
                            <div>
                                @if($data[0]->timeline_perkuliahan == 1)
                                Perkuliahan
                                @elseif($data[0]->timeline_perkuliahan == 2)
                                Soal Ujian Tengah Semester
                                @else
                                Soal Ujian Akhir Semester
                                @endif
                            </div>
                            <div>
                                {{$data[0]->tanggal_verifikasi}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                    <th>Kelengkapan</th>
                                    <th>Tipe Penilaian</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;">
                            <?php $no = 1; ?>
                            @forelse($dokumen as $d)
                            <tr>
                               <td>{{$no++}}</td>
                               <td>{{$d->point_penilaian_kelengkapan_dokumen}}</td>
                               <td>{{$d->tipe_penilaian}}</td>
                               <td>{{$d->penilaian}}</td>
                               <td>
                                    @if($d->keterangan == null)
                                    -
                                    @else
                                    {{$d->keterangan}}
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Tidak Ada Data</td>
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


@section('modal')
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Verifikasi</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form', 'files' => 'true'))}}
                    {{ csrf_field() }}

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Tanda Tangan Ketua GKM:', ['class' => 'awesome'])}}
                         <input type="file" class="form-control" name="file" id="file" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-secondary" value="Save">
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js')
<script>
$(document).ready( function () {
    $(document).on('click', '#verifikasi', function() {
        $('#modal').modal('show');

        $('#form').attr('action', '{{ url('gkm/monev/update') }}/{{$data[0]->id_kelas_perkuliahan}}');
    });

    $('#simpan').submit(function(e) {
    e.preventDefault();
    var formData = new FormData($(this)[0]);
    $.ajax({
        type: 'POST',
        url: $(this).attr('action')+'?_token='+'{{ csrf_token() }}',
        data: formData,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success :function () {
            alert(data.success);
            $('#modal').modal('hide');
            location.reload();
        },
    });
});

    });
</script>
@endsection
