@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Pembuatan Kontrak Perkuliahan</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card-header py-3">
                <h4 class="mb-0">Mata Kuliah : {{$data->matakuliah->nama_matakuliah}}</h4>
            </div>
            <div class="card shadow mb-4">
                <div class="card-body border-bottom-secondary">
                    {{Form::open(array('url' => 'dosen/kelas-perkuliahan/detail/kontrak/store' ,'method' => 'POST', 'id' => 'form'))}}
                    {{ csrf_field() }}
                    <input type="hidden" id="kelas_perkuliahan" name="kelas_perkuliahan" value="{{$id}}">
                    <div class="form-group" id="div_nama">
                        {{Form::label('text', '1. Rencana Pembelajaran Semester/Silabus :', ['class' => 'awesome'])}}
                        <textarea class="form-control " id="summary-ckeditor" name="summary_ckeditor[]" required></textarea>
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', '2. Metode/Sistem/Model Perkuliahan yang diterapkan :', ['class' => 'awesome'])}}
                        <textarea class="form-control" id="summary-ckeditor1" name="summary_ckeditor[]" required></textarea>
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', '3. Buku perkuliahan yang digunakan beserta nama pengarangnya :', ['class' => 'awesome'])}}
                        <textarea class="form-control" id="summary-ckeditor2" name="summary_ckeditor[]" required></textarea>
                    </div>

                    <div class="form-group" id="div_nama">
                        {{Form::label('text', '4. Bobot kriteria penilaian :', ['class' => 'awesome'])}}
                        <textarea class="form-control" id="summary-ckeditor3" name="summary_ckeditor[]" required></textarea>
                    </div>

                    <input type="submit" class="btn btn-secondary" value="Save">
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="http://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'summary-ckeditor' );
CKEDITOR.replace( 'summary-ckeditor1' );
CKEDITOR.replace( 'summary-ckeditor2' );
CKEDITOR.replace( 'summary-ckeditor3' );
$(document).ready( function () {
    

});
</script>
@endsection