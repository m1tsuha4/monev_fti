@extends('layouts._template')

@section('css')
    <link href="{{asset('template/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('main')
<div class="card shadow mb-4">
    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-secondary">Data Profile</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-10">
                {{Form::open(array('method' => 'POST', 'url' => 'profile/update', 'id' => 'form', 'file' => 'true'))}}
                {{ csrf_field() }}
                <div class="form-group" id="div_nama">
                    {{Form::label('text', 'Nama :', ['class' => 'awesome'])}}
                    {{Form::text('nama', Auth::user()->nama_dosen, ['class' => 'form-control', 'id' => 'nama'])}}
                </div>
                <div class="form-group" id="div_nama">
                    {{Form::label('text', 'Nip :', ['class' => 'awesome'])}}
                    {{Form::text('nip', Auth::user()->nip_dosen ,['class' => 'form-control', 'id' => 'nip','readonly' => 'true'])}}
                </div>
                <div class="form-group" id="div_nama">
                    {{Form::label('text', 'Jabatan :', ['class' => 'awesome'])}}
                    {{Form::text('jabatan', Auth::user()->jabatan ,['class' => 'form-control', 'id' => 'jabatan'])}}
                </div>
                <div class="form-group" id="div_nama">
                    {{Form::label('text', 'Email :', ['class' => 'awesome'])}}
                    {{Form::email('email', Auth::user()->email ,['class' => 'form-control', 'id' => 'email'])}}
                </div>
                <div class="form-group" id="div_nama">
                    {{Form::label('text', 'Password :', ['class' => 'awesome'])}}
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group" id="div_nama">
                    {{Form::label('text', 'Foto :', ['class' => 'awesome'])}}
                    <input type="file" name="foto" class="form-control">
                </div>
                <input type="submit" class="btn btn-info" value="Save">
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')

@endsection

@section('js')
<script>
$(document).ready( function () {

    });
</script>
@endsection
