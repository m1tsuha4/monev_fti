@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Berkas Kelas Perkuliahan</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-secondary">Berkas Perkuliahan</h6>
                        </div>
                        <div class="col-md-6 text-right">
                            <!-- <a href="{{url('/dosen/kelas-perkuliahan/detail/kontrak/create')}}/{{$kelas->id_kelas_perkuliahan}}" id="add" class="btn btn-secondary btn-sm">
                                <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span>
                                <span class="text"><i class="fa fa-plus"></i> Buat Kontrak Perkuliahan</span>
                            </a> -->
                            <a href="#" id="add" class="btn btn-secondary btn-sm">
                                <!-- <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span> -->
                                <span class="text"><i class="fa fa-plus"></i> Upload Berkas Perkuliahan</span>
                            </a>
                            <a href="#" id="add1" class="btn btn-secondary btn-sm">
                                <!-- <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span> -->
                                <span class="text"><i class="fa fa-plus"></i> Upload Soal Ujian</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-secondary">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Berkas</th>
                                    <th>Kategori Berkas</th>
{{--                                    <th>Tanggal Upload</th>--}}
                                    <th>Status</th>
{{--                                    <th>Keterangan</th>--}}
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
                                        <a id="pdf" href="{{ $b->file_rps }}"><i class="fa fa-file"></i></a>
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
                                        <a style="text-decoration:none" href="#" data-id="{{$b->id_kelas_perkuliahan}}" data-nama="{{$b->id_kelas_perkuliahan}}" data-id1="{{$b->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>Berkas RTM</td>
                                    <td class="text-center">
                                        <a id="pdf" href="{{ $b->file_rtm }}"><i class="fa fa-file"></i></a>
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
                                        <a style="text-decoration:none" href="#" data-id="{{$b->id_kelas_perkuliahan}}" data-nama="{{$b->id_kelas_perkuliahan}}" data-id1="{{$b->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>Berkas Kontrak Perkuliahan</td>
                                    <td class="text-center">
                                        {{--                                        <a id="pdf" href="{{ $b->file_kontrak_perkuliahan }}"><i class="fa fa-file"></i></a>--}}
                                        <a href="{{ asset('storage/'.$b->file_kontrak_perkuliahan) }}"><i class="fa fa-file"></i></a>
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
                                        <a style="text-decoration:none" href="#" data-id="{{$b->id_kelas_perkuliahan}}" data-nama="{{$b->id_kelas_perkuliahan}}" data-id1="{{$b->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
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
                                        <a id="pdf" href="#" data-id="{{$b->id_kategori_berkas}}" data-id1="{{$b->id_kelas_perkuliahan}}"><i class="fa fa-file"></i></a>
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
                                        <a style="text-decoration:none" href="#" data-id="{{$bs->id_kelas_perkuliahan}}" data-nama="{{$bs->id_kelas_perkuliahan}}" data-id1="{{$bs->id_kelas_perkuliahan}}" id="add" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a>
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

        <!-- <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="m-0 font-weight-bold text-secondary">Info Kelas</h6>
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
                                    <th>Kurikulum</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Upload Berkas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form', 'files' => 'true'))}}
                    {{ csrf_field() }}
                    <input type="hidden" id="id_kelas" name="id_kelas" value="{{$kelas->id_kelas_perkuliahan}}">

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Berkas RPS:', ['class' => 'awesome'])}}
                        <input type="file" name="rps" class="form-control">
                        <input type="hidden" id="kategori_rps" name="kategori_rps" value="B01">
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Berkas RTM:', ['class' => 'awesome'])}}
                        <input type="file" name="rtm" class="form-control">
                        <input type="hidden" id="kategori_rtm" name="kategori_rtm" value="B02">
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Berkas Kontrak Perkuliahan:', ['class' => 'awesome'])}}
                        <input type="file" name="kontrak" class="form-control">
                        <input type="hidden" id="kategori_kontrak" name="kategori_kontrak" value="B03">
                    </div>

                    <!-- <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Berkas BAP:', ['class' => 'awesome'])}}
                        <input type="file" name="bap" class="form-control">
                        <input type="hidden" id="kategori_bap" name="kategori_bap" value="B04">
                    </div> -->
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Upload Berkas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form1', 'files' => 'true'))}}
                    {{ csrf_field() }}

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Id Soal :', ['class' => 'awesome'])}}
                        {{Form::number('id_soal','',['class' => 'form-control', 'id' => 'id_soal', 'placeholder' => 'Id Soal ...'])}}
                    </div>
                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Nama Soal :', ['class' => 'awesome'])}}
                        {{Form::text('nama_soal','',['class' => 'form-control', 'id' => 'nama_soal', 'placeholder' => 'Nama Soal ...'])}}
                    </div>
                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Berkas :', ['class' => 'awesome'])}}
                        <input type="file" name="berkas" class="form-control">
                        <input type="hidden" id="id_kelas1" name="id_kelas1" value="{{$kelas->id_kelas_perkuliahan}}">
                        <input type="hidden" id="kategori_berkas" name="kategori_berkas" value="">
                    </div>

{{--                    <div class="form-group" id="div_kategori">--}}
{{--                        {{Form::label('text', 'Kategori Berkas :', ['class' => 'awesome'])}}--}}
{{--                        <select name="id_kategori" id="id_kategori" class="form-control">--}}
{{--                            @foreach($kategori as $r)--}}
{{--                                <option value="{{$r->id_kategori_berkas}}">{{$r->nama_berkas}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}


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
        $('#div_kategori').show();
        $('#form').attr('action', '{{ url('dosen/kelas-perkuliahan/berkas/create') }}/'+1);
    });

    $(document).on('click', '#add1', function() {
        $('#modal1').modal('show');
        $('#form1').attr('action', '{{ url('dosen/kelas-perkuliahan/berkas/create') }}/'+2);
    });

    $(document).on('click', '#edit', function() {
        $('#modal1').modal('show');
        $('#div_kategori').hide();
        var id = $(this).data('id');
        $.ajax({
            type: "get",
            url: "{{ url('/dosen/kelas-perkuliahan/berkas/edit') }}/"+id+"/"+"{{$kelas->id}}",
            dataType: "json",
            success: function(data) {
                console.log(data[0].id);
                event.preventDefault();
                var kategori_berkas=data[0].id_kategori_berkas

                $('#kategori_berkas').val(kategori_berkas).change();
                console.log(kategori_berkas);
                $('#form1').attr('action', '{{ url('dosen/kelas-perkuliahan/berkas/update') }}/'+id);
            }
        });
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
