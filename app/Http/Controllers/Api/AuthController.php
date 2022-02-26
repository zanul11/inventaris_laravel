<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Rekening;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $r)
    {
        $res = [
            'status' => 'Unauthorized',
        ];
        $credentials = request(['user', 'password']);
        $user = $r->user;

        $user = User::where('user', $user)->first();
        if (!$user) {
            return response()->json([
                'status' => 'Unauthorized',
            ]);
        }
        if (!Hash::check($r->password, $user->password)) {
            return response()->json([
                'status' => 'Unauthorized',
            ]);
        }
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'Unauthorized',
            ]);
        }
        DB::table('users')
            ->where('user', $user->user)
            ->update([
                "notif_id" => $r->notif_id,
            ]);
        // return $r->notif_id;
        return response()->json([
            'status' => 'Success',
        ]);
    }

    public function getData()
    {
        $date = date('m/Y');
        $rekening = Rekening::where('cBlth', $date)->where('lBaca', 0)->get();
        return response()->json($rekening);
    }

    public function upload(Request $r)
    {
        $date = date('m/Y');
        DB::table('rekenings')
            ->where('nik', $r->nik)
            ->where('cBlth', $date)
            ->update(['lBaca' => 1, 'nStIni' => $r->nStIni, 'nPakai' => $r->nPakai, 'dtglCatat' => $r->dTglCatat, 'dtglUpload' => date('Y-m-d H:m:i')]);   //Paid

        return response()->json([
            'status' => true,
        ]);
    }
}
