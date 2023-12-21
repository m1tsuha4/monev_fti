@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dosen Page</h1>
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
                                    <th>Nip</th>
                                    <th>Prodi</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Status</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Form User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::open(array('method' => 'POST', 'id' => 'form'))}}
                    {{ csrf_field() }}
                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Nip User :', ['class' => 'awesome'])}}
                        {{Form::text('nip','',['class' => 'form-control', 'id' => 'nip', 'placeholder' => 'Nip Dosen...'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Prodi :', ['class' => 'awesome'])}}
                        <select name="prodi" id="prodi" class="form-control">
                            @foreach($prodi as $r)
                                <option value="{{$r->kode_prodi}}">{{$r->nama_prodi}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Jabatan User :', ['class' => 'awesome'])}}
                        {{Form::text('jabatan','',['class' => 'form-control', 'id' => 'jabatan', 'placeholder' => 'Jabatan...'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Nama User :', ['class' => 'awesome'])}}
                        {{Form::text('nama','',['class' => 'form-control', 'id' => 'nama_dosen', 'placeholder' => 'Nama ...'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Status User :', ['class' => 'awesome'])}}
                        {{Form::select('status',['1' => 'Ketua Jurusan','2' => 'Ketua GKM','3' => 'Dosen'],null,['class' => 'form-control', 'id' => 'status'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Email :', ['class' => 'awesome'])}}
                        {{Form::email('email','',['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email ...'])}}
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', 'Password :', ['class' => 'awesome'])}}
                        {{Form::password('password',['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password ...'])}}
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
            language: {
                "emptyTable": "Tidak Ada Data Tersimpan"
            },
            ajax: "{{ url('/jurusan/users/data') }}",
                "columns": [
                    {
                        "data": "nip_dosen",
                        class: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { "data": "nip_dosen"},
                    { "data": "prodi.nama_prodi"},
                    { "data": "nama_dosen"},
                    { "data": "email",},
                    {
                        data: 'jabatan',
                        sClass: 'text-center',
                    },
                    {
                        data: 'status',
                        sClass: 'text-center',
                        render: function(data){
                            if(data == 1){
                                return '<span class="text-center">Ketua Jurusan</span>';
                            }else if(data == 2){
                                return '<span class="text-center">Ketua GKM</span>';
                            }else{
                                return '<span class="text-center">Dosen</span>';
                            }
                        },
                    },
                    {
                        data: 'nip_dosen',
                        sClass: 'text-center',
                        render: function(data) {
                            return '<a style="text-decoration:none" href="#" data-id="'+data+'" id="edit" class="text-secondary" title="edit"><i class="fas fa-edit"></i></a> &nbsp;'+
                                '<a style="text-decoration:none" href="#" data-id="'+data+'" id="delete" class="text-secondary" title="hapus"><i class="fas fa-trash"></i> </a>';
                        },
                    }
                ],
            });

    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 5000 );

    $(document).on('click', '#add', function() {
        $('#modal').modal('show');
        $('#nip').val("");
        $('#nama_dosen').val("");
        $('#jabatan').val("");
        $('#email').val("");
        $('#password').val("");
        $('#form').attr('action', '{{ url('jurusan/users/create') }}');
    });

    $(document).on('click', '#edit', function() {
        $('#modal').modal('show');
        var id = $(this).data('id');
        $.ajax({
            type: "get",
            url: "{{ url('/jurusan/users/edit') }}/"+id,
            dataType: "json",
            success: function(data) {
                console.log(data[0].id);
                event.preventDefault();
                var nip=data[0].nip_dosen
                var nama_dosen=data[0].nama_dosen
                var jabatan=data[0].jabatan
                var email=data[0].email

                $('#nip').val(nip).change();
                $('#nama_dosen').val(nama_dosen).change();
                $('#jabatan').val(jabatan).change();
                $('#email').val(email).change();
                $('#form').attr('action', '{{ url('jurusan/users/update') }}/'+id);
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
                    url : "{{ url('jurusan/users/delete') }}/"+id,
                    success :function () {
                        location.reload();
                    }
                })
            }
    });

    });
</script>
@endsection
