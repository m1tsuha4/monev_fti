@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelas Perkuliahan Page</h1>
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
                            <a href="#" id="add" class="btn btn-secondary btn-sm">
                                <!-- <span class="icon text-white-50">
                                    <i class="fa fa-plus"></i>
                                </span> -->
                                <span class="text"><i class="fa fa-plus"></i> Tambah</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body border-bottom-secondary">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="table" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode KelasPerkuliahan</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Matakuliah</th>
                                    <th>Dosen Pengampu</th>
                                    <th>Kelas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:13px;">

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
                    <h5 class="modal-title" id="exampleModalLabel">Form Jabwal Kelas Perkuliahan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form'))}}
                    {{ csrf_field() }}

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'kode_kelasperkuliahan :', ['class' => 'awesome'])}}
                        {{Form::text('kode_kelasperkuliahan','',['class' => 'form-control', 'id' => 'kode_kelasperkuliahan', 'placeholder' => 'Kode Kelas Perkuliahan...'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Tahun Ajaran Akademik :', ['class' => 'awesome'])}}
                        <select name="tahun_akademik" id="tahun_akademik" class="form-control">
                            @foreach($tahun_akademik as $t)
                                <option value="{{$t->id_tahun_akademik}}">Tahun {{$t->tahun}} | Semester {{$t->semester}}</option>
                            @endforeach
                        </select>
                    </div>

{{--                    <div class="form-group" id="div_nama">--}}
{{--                        {{Form::label('text', 'Kurikulum :', ['class' => 'awesome'])}}--}}
{{--                        {{Form::text('kurikulum','',['class' => 'form-control', 'id' => 'kurikulum', 'placeholder' => 'Kurikulum Matakuliah ...'])}}--}}
{{--                    </div>--}}

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Kelas Perkuliahan :', ['class' => 'awesome'])}}
                        {{Form::text('kelas','',['class' => 'form-control', 'id' => 'kelas', 'placeholder' => 'A atau B'])}}
                        <!-- <select name="kelas" id="kelas" class="form-control">
                            <option value="teori">Kelas Teori</option>
                            <option value="praktikum">Kelas Praktikum</option>
                        </select> -->
                    </div>

                    <div class="form-group" id="div_matakuliah">
                        {{Form::label('text', 'Matakuliah :', ['class' => 'awesome'])}}
                        <select name="matakuliah" id="matakuliah" class="form-control">
                            @foreach($matakuliah as $r)
                                <option value="{{$r->kode_matakuliah}}">{{$r->nama_matakuliah}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group" id="div_nama">
                                {{Form::label('text', 'Dosen Pengampu :', ['class' => 'awesome'])}}
                                <select name="dosen_pengampu" id="dosen_pengampu" class="form-control">
                                    @foreach($dosen as $r)
                                        <option value="{{$r->nip_dosen}}">{{$r->nama_dosen}} | {{$r->prodi->nama_prodi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{--                        <div class="col">--}}
{{--                            <div class="form-group" id="div_nama">--}}
{{--                                {{Form::label('text', 'Dosen Pengampu 2:', ['class' => 'awesome'])}}--}}
{{--                                <select name="dosen_pengampu1" id="dosen_pengampu1" class="form-control">--}}
{{--                                    <option value=""> - </option>--}}
{{--                                    @foreach($dosen as $r)--}}
{{--                                        <option value="{{$r->nip_dosen}}">{{$r->nama_dosen}} | {{$r->prodi->nama_prodi}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col">--}}
{{--                            <div class="form-group" id="div_nama">--}}
{{--                                {{Form::label('text', 'Dosen Pengampu 3:', ['class' => 'awesome'])}}--}}
{{--                                <select name="dosen_pengampu2" id="dosen_pengampu2" class="form-control">--}}
{{--                                    <option value=""> - </option>--}}
{{--                                    @foreach($dosen as $r)--}}
{{--                                        <option value="{{$r->nip_dosen}}">{{$r->nama_dosen}} | {{$r->prodi->nama_prodi}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>


                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Dosen Verifikator :', ['class' => 'awesome'])}}
                        <select name="dosen_verifikator" id="dosen_verifikator" class="form-control">
                            @foreach($dosen as $r)
                                <option value="{{$r->nip_dosen}}">{{$r->nama_dosen }} | {{$r->prodi->nama_prodi}}</option>
                            @endforeach
                        </select>
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
        var table = $('#table').DataTable( {
            "pageLength": 50,
            language: {
                "emptyTable": "Tidak Ada Data Tersimpan"
            },
            ajax: "{{ url('/jurusan/kelas-perkuliahan/data') }}",
                "columns": [
                    {
                        "data": "id_kelas_perkuliahan",
                        class: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: "id_kelas_perkuliahan",
                        sClass : "text-center",

                    },
                    {
                        data: "tahun",
                        sClass : "text-center",

                    },
                    {
                        data: "nama_matakuliah",
                        sClass : "text-center",
                    },
                    {
                        data: "nama_dosen",
                        sClass : "text-center",
                    },
                    {
                        data: "kelas",
                        sClass : "text-center",
                    },
                    {
                        data: 'id_kelas_perkuliahan',
                        sClass: 'text-center',
                        render: function(data) {
                            // return '<a style="text-decoration:none" href="#" data-id="'+data+'" id="edit" class="text-secondary" title="edit"><i class="fas fa-edit"></i></a> &nbsp;'+
                               return '<a style="text-decoration:none" href="#" data-id="'+data+'" id="delete" class="text-secondary" title="hapus"><i class="fas fa-trash"></i> </a>';
                        },
                    }
                ],
            });

    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 5000 );

    $(document).on('click', '#add', function() {
        $('#modal').modal('show');
        $('#div_matakuliah').show();
        $('#kode_kelasperkuliahan').val("");
        $('#tahun_akademik').val("");
        // $('#kurikulum').val("");
        $('#form').attr('action', '{{ url('jurusan/kelas-perkuliahan/create') }}');
    });

    $(document).on('click', '#edit', function() {
        $('#modal').modal('show');
        $('#div_matakuliah').hide();
        var id = $(this).data('id_kelas_perkuliahan');
        $.ajax({
            type: "get",
            url: "{{ url('/jurusan/kelas-perkuliahan/edit') }}/"+id,
            dataType: "json",
            success: function(data) {
                console.log(data[0].id);
                event.preventDefault();
                var kode_kelasperkuliahan=data[0].id_kelas_perkuliahan
                var tahun_akademik=data[0].id_tahun_akademik
                // var kurikulum=data[0].kurikulum
                var kelas=data[0].kelas

                $('#kode_kelasperkuliahan').val(kelas_perkuliahan).change();
                $('#tahun_akademik').val(tahun_akademik).change();
                // $('#kurikulum').val(kurikulum).change();
                $('#kelas').val(kelas).change();
                $('#form').attr('action', '{{ url('jurusan/kelas-perkuliahan/update') }}/'+id);
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

    $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
            if (confirm("Anda Yakin ingin menghapus data?")){
                $.ajax({
                    url : "{{ url('jurusan/kelas-perkuliahan/delete') }}/"+id,
                    success :function () {
                        location.reload();
                    }
                })
            }
    });

    });
</script>
@endsection
