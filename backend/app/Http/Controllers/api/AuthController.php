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
                    "user" => null,
                    "message" => "Invalid login details",
                    "status" => "failed",
                ],
                401
            );
        }

        $user = User::where("email", $request["email"])->firstOrFail();
        $karyawan = $user->karyawan;

        $divisi = $karyawan->devisi ? $karyawan->devisi->nama_divisi : null;

        $token = $user->createToken("auth_token")->plainTextToken;

        $user_loggedin = [
            'id_karyawan' => (string) $karyawan->id_karyawan,
            'email' => $user->email,
            'role' => $user->role,
            'user_token' => $token,
            'token_type' => 'Bearer',
            'verified' => true,
            'status' => 'loggedin',
            'name' => $karyawan->nama,
            'divisi' => $divisi,
            'alamat' => $karyawan->alamat,
            'ttl' => $karyawan->ttl,
            'jenis_kelamin' => $karyawan->jenis_kelamin,
            'no_hp' => $karyawan->no_hp,
            'foto' => $karyawan->foto,
        ];

        return response()->json($user_loggedin, 200);
    }

}
