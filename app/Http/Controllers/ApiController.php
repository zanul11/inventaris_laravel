<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
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
}
