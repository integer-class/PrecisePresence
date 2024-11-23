<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
class AuthController extends Controller
{


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only("email", "password"))) {
            return response()->json(
                [
                    "user" => Null,
                    "message" => "Invalid login details",
                    "stus" => "failed",
                ],
                200
            );
        }
        $user = User::where("email", $request["email"])->firstOrFail();
        $karyawan = $user->karyawan;
        $token = $user->createToken("auth_token")->plainTextToken;

        $user_loggedin=[
<<<<<<< HEAD
            'id_karyawan' => (string)$karyawan->id_karyawan, // Cast to string            
=======
            'id_karyawan' => (string)$karyawan->id_karyawan, // Cast to string
>>>>>>> b74b0566d792cae06ddbcc47381c2fbe7969a427
            'email' => $user->email,
            'role' => $user->role,
            'user_token' => $token,
            'token_type' => 'Bearer',
            'verified' => true,
            'status'=>'loggedin',
            'name' => $karyawan->nama,
            'divisi' => $karyawan->divisi,
            'alamat' => $karyawan->alamat,
            'ttl' => $karyawan->ttl,
            'jenis_kelamin' => $karyawan->jenis_kelamin,
            'no_hp' => $karyawan->no_hp,
            'foto' => $karyawan->foto,




        ];
        return response()->json(
            $user_loggedin,
            200
        );
    }
}
