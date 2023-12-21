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
                                    <th>Kelas</th>
                                    <th>Kurikulum</th>
                                    <th>Berkas</th>
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

@section('js')
<script>
$(document).ready( function () {
        var table = $('#table').DataTable( {
            "pageLength": 50,
            language: {
                "emptyTable": "Tidak Ada Data Tersimpan"
            },
            ajax: "{{ url('/dosen/kelas-perkuliahan/data') }}",
                "columns": [
                    {
                        "data": "id_kelas_perkuliahan",
                        class: "text-center",
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
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
                        data: "kelas",
                        sClass : "text-center",

                    },
                    {
                        data: "tahun_kurikulum",
                        sClass : "text-center",
                    },
                    {
                        data: 'id_kelas_perkuliahan',
                        sClass: 'text-center',
                        render: function(data) {
                            return '<a style="text-decoration:none" href="#" data-id="'+data+'" id="detail" class="text-secondary" title="Upload File"><i class="fa fa-upload"></i></a> ';
                        },
                    },
                    {
                        data: 'id_kelas_perkuliahan',
                        sClass: 'text-center',
                        render: function(data) {
                            return '<a style="text-decoration:none" href="#" data-id="'+data+'" id="detail1" class="text-secondary" title="Detail"><i class="fa fa-ellipsis-h"></i></a> ';
                        },
                    }
                ],
            });

    setInterval( function () {
        table.ajax.reload( null, false ); // user paging is not reset on reload
    }, 5000 );

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
