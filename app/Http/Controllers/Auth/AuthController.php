<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use DB;
use Mail;

class AuthController
{
    public function login(){
        return view('pages.frontend.auth.signin');
    }

    public function loginProcess(Request $request){
        $request->validate([
            'email'     => 'required|email',
            'password'  => 'required',
        ],[
            'email.required'    => 'Email harus diisi',
            'email.email'       => 'Email tidak valid',
            'password.required' => 'Password harus diisi'
        ]);
        $user  = User::where('email',$request->email)->first();
        if(!$user){
            return response()->json([
                'success'   => false,
                'message'   => 'Email belum melakukan registrasi',
                'code'      => '205'
            ]);
        }else{
            if(!Hash::check($request->password, $user->password)){
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal.cek kembali email/password anda kembali',
                    'code'    => '400'
                ]);
            }
            $login = [
                'email'     => $user->email,
                'password'  => $request['password']
            ];
            if (Auth::attempt($login)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil login'
                ]);
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'gagal login',
                    'code'    => '400'
                ]);
            }

        }
    }

    public function signup(){
        return view('pages.frontend.auth.signup');
    }


    public function storeSignup(Request $request){
        $request->validate([
            'name'  => 'required',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6|same:confirm_password',
        ],[
            'name.required'  => 'Nama harus diisi',
            'name.unique'    => 'Nama sudah terdaftar',
            'email.required'         => 'Email harus diisi',
            'email.email'            => 'Email tidak valid',
            'email.unique'           => 'Email sudah terdaftar',
            'email.required'         => 'Email harus diisi',
            'password.required'      => 'Password harus diisi',
            'password.min'           => 'Password tidak boleh kurang dari 6 digit',
            'password.same'          => 'Konfirmasi password tidak sama',
        ]);
        $micro_id        = explode(" ", microtime());
        $micro_id        = $micro_id[1].substr($micro_id[0],2,6);
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $hash            = substr(str_shuffle($permitted_chars), 0, 12);
        $data            = $request->all();

        DB::beginTransaction();
        try {
            $check = User::where('email',$data['email'])->first();
            if($check){
                return response()->json([
                    'success' => false,
                    'message' => 'user telah terdaftar'
                ]);
            }
            $registrasi      = User::create([
                'name'      => $data['name'],
                'email'     => $data['email'],
                'password'      => Hash::make($data['password']),
                'register_token'=> $micro_id.$hash,
            ]);

            $array['nama']     = $registrasi->name;
            $array['email']    = $registrasi->email;
            $array['date_now'] = date("d-m-Y H:i:s");
            $array['subject']  = "Register user";
            $array['hash']     = $micro_id.$hash;
            $array['email']    = $registrasi->email;

            DB::commit();
            Auth::login($registrasi);
            return response()->json([
                'success'   => true,
                'message'   => 'Akun sudah terdaftar'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json([
                'success'   => false,
                'message'   => 'mohon maaf terdapat kesalahan di sistem kami, silahkan coba beberapa saat lagi'
            ]);
        }

    }

}
