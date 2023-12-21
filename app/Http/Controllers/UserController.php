<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prodi;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    //user home

    public function jurusan_index()
    {
        return view('Ketua_Jurusan.index');
    }

    public function gkm_index()
    {
        return view('GKM.index');
    }

    public function dosen_index()
    {
        return view('Dosen.index');
    }

    public function profile()
    {
        return view('profile');
    }

    public function profile_update(Request $request)
    {
        if($request->password != null){
            $file = $request->file('foto');
            if($file == null){
              User::where('nip_dosen',$request->nip)->update([
                    'nama_dosen' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'email' => $request->email,
                    'password' =>bcrypt($request->password),
                ]);
            }else{
                if ($file->isValid()) {
                    $path = $file->store('public/foto');
                    User::where('nip_dosen',$request->nip)->update([
                        'nama_dosen' => $request->nama,
                        'jabatan' => $request->jabatan,
                        'email' => $request->email,
                        'password' =>bcrypt($request->password),
                        'foto' => $path
                    ]);
                }
            }

        }else{
            $file = $request->file('foto');
            if($file == null){
                User::where('nip_dosen',$request->nip)->update([
                    'nama_dosen' => $request->nama,
                    'jabatan' => $request->jabatan,
                    'email' => $request->email,
                ]);
            }else{
                if ($file->isValid()) {
                    $path = $file->store('public/foto');
                    User::where('nip_dosen',$request->nip)->update([
                        'nama_dosen' => $request->nama,
                        'jabatan' => $request->jabatan,
                        'email' => $request->email,
                        'foto' => $path
                    ]);
                }
            }
        }
        return view('profile');
    }
    // end user home

    // Jurusan
    public function jurusan(){
        $prodi = Prodi::all();
        return view('Ketua_Jurusan.master.user', compact('prodi'));
    }

    public function jurusan_data(){
        $user = User::with('prodi')->get();
        return response()->json(['data' => $user]);
    }

    public function jurusan_store(Request $request){
        $now = Carbon::now()->format('Y-m-d H:i:s');

         User::create([
            'nip_dosen' => $request->nip,
            'kode_prodi' => $request->prodi,
            'nama_dosen' => $request->nama,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
            'foto' => null,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'email_verified_at' => $now,
        ]);

        return redirect()->route('jurusan.user')->with('success', 'Data Berhasil Di Simpan');
    }

    public function jurusan_edit($id){
        $user = User::where('nip_dosen',$id)->get();
        return $user->toJson();
    }

    public function jurusan_update(Request $request, $id){
        if($request->password == null){
            User::where('nip_dosen',$id)->update([
                'kode_prodi' => $request->prodi,
                'nama_dosen' => $request->nama,
                'jabatan' => $request->jabatan,
                'status' => $request->status,
                'email' => $request->email,
            ]);
        }else{
            User::where('nip_dosen',$id)->update([
                'kode_prodi' => $request->prodi,
                'nama_dosen' => $request->nama,
                'jabatan' => $request->jabatan,
                'status' => $request->status,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
            ]);
        }

        return redirect()->route('jurusan.user')->with('success', 'Data Berhasil Di Simpan');
    }

    public function jurusan_delete($id){
        User::where('nip_dosen', $id)->delete();
    }
    // End Jurusan
}
