@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Informasi Monev</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-secondary">Table Data</h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="#" id="add1" data-id="{{$data->id_kelas_perkuliahan}}" class="btn btn-danger btn-sm">
                                <!-- <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span> -->
                                <span class="text">Berikan Penilaian</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-secondary">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Berkas</th>
{{--                                    <th>Tanggal Upload</th>--}}
                                    <th>Berkas</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;">
                            <?php
                                $no = 1;
                            ?>
                            @forelse($berkas as $b)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>Berkas RPS</td>
                                    <td class="text-center">
{{--                                        <a href="{{ asset($b->file_rps) }}"><i class="fa fa-file"></i></a>--}}
                                        <a id="pdf1" href="#" data-id="" data-id1="{{$b->id_kelas_perkuliahan}}" data-id3="1"><i class="fa fa-file"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if($b->status == 1)
                                            <span class="badge badge-warning">Need Action</span>
                                        @elseif($b->status == 2)
                                            <span class="badge badge-success">Accept</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a style="text-decoration:none" href="#" data-id="" data-nama="{{$b->id_kelas_perkuliahan}}" data-id1="{{$b->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>Berkas RTM</td>
                                    <td class="text-center">
                                        <a id="pdf1" href="#" data-id="" data-id1="{{$b->id_kelas_perkuliahan}}" data-id3="2"><i class="fa fa-file"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if($b->status == 1)
                                            <span class="badge badge-warning">Need Action</span>
                                        @elseif($b->status == 2)
                                            <span class="badge badge-success">Accept</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a style="text-decoration:none" href="#" data-id="" data-nama="{{$b->id_kelas_perkuliahan}}" data-id1="{{$b->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>Berkas Kontrak Perkuliahan</td>
                                    <td class="text-center">
                                        <a id="pdf1" href="#" data-id="" data-id1="{{$b->id_kelas_perkuliahan}}" data-id3="3"><i class="fa fa-file"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if($b->status == 1)
                                            <span class="badge badge-warning">Need Action</span>
                                        @elseif($b->status == 2)
                                            <span class="badge badge-success">Accept</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a style="text-decoration:none" href="#" data-id="" data-nama="{{$b->id_kelas_perkuliahan}}" data-id1="{{$b->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">Tidak Ada Ada</td>
                                </tr>
                            @endforelse

                            @forelse($berkas_soal as $bs)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>Berkas Soal</td>
                                    {{--                                        <td>{{$b->tanggal_upload}}</td>--}}
                                    <td class="text-center">
                                        <a id="pdf" href="#" data-id="{{$bs->id_soal }}" data-id1="{{$bs->id_kelas_perkuliahan}}"><i class="fa fa-file"></i></a>
                                    </td>
                                    <td class="text-center">
                                        @if($bs->status == 1)
                                            <span class="badge badge-warning">Need Action</span>
                                        @elseif($bs->status == 2)
                                            <span class="badge badge-success">Accept</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a style="text-decoration:none" href="#" data-id="{{$bs->id_soal}}" data-nama="{{$bs->id_kelas_perkuliahan}}" data-id1="{{$bs->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="6">Tidak Ada Ada</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Kategori Berkas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form'))}}
                    {{ csrf_field() }}

                    <input type="hidden" name="id_kelas_perkuliahan" id="id_kelas_perkuliahan" value="{{ $data->id_kelas_perkuliahan }}">
                    <input type="hidden" name="id_kategori_berkas" id="id_kategori_berkas" value="">

{{--                    <div class="form-group" id="div_nama">--}}
{{--                        {{Form::label('text', 'Berkas Kelengkapan :', ['class' => 'awesome'])}}--}}
{{--                        {{Form::text('nama_berkas','',['class' => 'form-control', 'id' => 'nama_berkas', 'placeholder' => 'Nama Berkas Kelengkapan ...'])}}--}}
{{--                    </div>--}}

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Status :', ['class' => 'awesome'])}}
                        {{Form::select('status',['0' => 'Rejected','2' => 'Accepted'],null,['class' => 'form-control', 'id' => 'status'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Keterangan :', ['class' => 'awesome'])}}
                        {{Form::text('keterangan','',['class' => 'form-control', 'id' => 'keterangan', 'placeholder' => 'Keterangan ...'])}}
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

    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Kategori Berkas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form1', 'files' => 'true'))}}
                    {{ csrf_field() }}

                    <input type="hidden" name="id_hasil_verifikator" id="id_hasil_verifikator" value="{{ $data->id_kelas_perkuliahan }}">

                    @foreach($kategori as $k)

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Kategori Penilaian :', ['class' => 'awesome'])}}
                        <input type="text" name="kategori_penilaian[]" id="kategori_penilaian" value="{{$k->point_penilaian_kelengkapan_dokumen}}" class="form-control" readonly>
                        <input type="hidden" name="id_jenis_penilaian[]" id="id_jenis_penilaian" value="{{$k->id_jenis_kelengkapan_dokumen}}">
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Nilai :', ['class' => 'awesome'])}}
                        {{Form::select('nilai[]',['Ada' => 'Ada','Tidak Ada' => 'Tidak Ada','Cukup' => 'Cukup','Baik' => 'Baik','Sangat Baik' => 'Sangat Baik','Sesuai' => 'Sesuai','Tidak Sesuai' => 'Tidak Sesuai'],null,['class' => 'form-control', 'id' => 'nilai','required' => 'true'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Keterangan :', ['class' => 'awesome'])}}
                        {{Form::text('keterangan[]','',['class' => 'form-control', 'id' => 'keterangan', 'placeholder' => 'Keterangan ...'])}}
                    </div>

                    @endforeach

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Tanda Tangan Verifikator :', ['class' => 'awesome'])}}
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

$(document).on('click', '#add', function() {
    $('#modal').modal('show');
    var nama = $(this).data('nama');
    var id_kategori_berkas = $(this).data('id');
    var id_kelas_perkuliahan = $(this).data('id1');

    console.log(id_kategori_berkas);
    console.log(id_kelas_perkuliahan);

    $('#nama_berkas').val(nama);
    $('#id_kategori_berkas').val(id_kategori_berkas);
    $('#id_kelas_perkuliahan').val(id_kelas_perkuliahan);
    $('#form').attr('action', '{{ url('dosen/monev/update') }}');
});

$(document).on('click', '#add1', function() {
    $('#modal1').modal('show');
    var id = $(this).data('id');
    $('#id_hasil_verifikator').val(id);
    $('#form1').attr('action', '{{ url('dosen/monev/create') }}');
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

$(document).on('click', '#pdf', function() {
    var id = $(this).data('id');
    var id1 = $(this).data('id1');
    window.open("{{ url('berkas') }}/"+id+'/'+id1);
});
$(document).on('click', '#pdf1', function() {
    var id1 = $(this).data('id1');
    var id3 = $(this).data('id3');
    window.open("{{ url('berkas-dokumen') }}/"+id1+'/'+id3);
});
});
</script>
@endsection
