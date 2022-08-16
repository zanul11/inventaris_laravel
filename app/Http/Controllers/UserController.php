<?php

namespace App\Http\Controllers;

use App\Akses;
use App\Jabatan;
use App\Menu;
use App\Pegawai;
use App\Pelanggan;
use App\Rekening;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Setup');
        $request->session()->put('child', 'User');
        // $user = User::with('jabatans')->paginate(10);
        return view('pages.user.index');
    }

    public function getServerSide()
    {
        $users = User::all();
        return Datatables::of($users)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $btn = '<div class="btn-group btn-group-sm" role="group">
                <a onclick="btnDelete(' . $row->id . ')" class="btn btn-danger" style="font-size:12px; color:white;">Hapus</a>
                <button id="" class="btn btn-white dropdown-toggle" data-toggle="dropdown"></button>
                <div class="dropdown-menu">
                    <a href="/user/' . $row->id . '" class="dropdown-item"> Edit</a>
                </div>
            </div>';
                return $btn;
            })

            ->make();
    }

    public function create()
    {
        $menus = DB::table('menus')->get();
        $childs = DB::table('menus')->get();
        $action = 'add';
        $user = User::first();
        return view('pages.user.create', compact('action', 'menus', 'childs',  'user'));
    }

    public function show(User $user)
    {
        // return $user;
        $action = '/user/' . $user->id;
        $menus = DB::table('menus')->where('menus.kd_menu', '!=', 'mn1')->get();
        $childs = DB::table('menus')->where('menus.kd_menu', '!=', 'mn1')->get();
        $menuaktifs = DB::table('akses')
            ->join('users', 'users.user', '=', 'akses.user')
            ->join('menus', 'menus.kd_menu', '=', 'akses.kd_menu')
            ->where('akses.user', $user->user)
            ->where('menus.kd_menu', '!=', 'mn1')
            ->select('menus.*')
            ->get();
        return view('pages.user.create', compact('action', 'menus', 'childs', 'user', 'menuaktifs'));
    }

    public function store(Request $request)
    {

        $cekUser = User::where('user', $request->user)->get();
        if (count($cekUser) > 0) {
            Alert::warning('Warning!', 'Duplicate User');
            return Redirect::to('/user/create')->withErrors(['Nama user tersebut telah digunakan.'])->withInput();
        } else {
            Akses::create([
                "user" => $request->user,
                "kd_menu" => 'mn1'
            ]);
            $jumAkses = ((isset($request->akses)) ? count($request->akses) : 0);
            for ($i = 0; $i < $jumAkses; $i++) {
                $menu = Menu::where('kd_menu', $request->akses[$i])->first();
                $cekParent = Akses::where('user', $request->user)->where('kd_menu', $menu['kd_parent'])->get();
                if (count($cekParent) <= 0) {
                    Akses::create([
                        "user" => $request->user,
                        "kd_menu" => $menu['kd_parent'],
                    ]);
                }
                Akses::create([
                    "user" => $request->user,
                    "kd_menu" => $request->akses[$i],
                ]);
            }
            User::create([
                "nama" => $request->nama,
                "user" => $request->user,
                "password" => bcrypt($request->password),
                "jabatan" => '-',
                "alamat" => '-',
                "type" => $request->tipe,
            ]);
            Alert::success('Success!', 'Data User Added!');
            return Redirect::to('/user');
        }
    }

    public function update(Request $request, User $user)
    {
        // return $request;
        DB::table('akses')->where('user', $user->user)->delete();
        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }
        $user->nama = $request->nama;
        $user->type = $request->tipe;
        $user->save();
        Akses::create([
            "user" => $user->user,
            "kd_menu" => 'mn1'
        ]);
        if (isset($request->akses)) {
            for ($i = 0; $i < count($request->akses); $i++) {
                $menu = Menu::where('kd_menu', $request->akses[$i])->first();
                $cekParent = Akses::where('user', $user->user)->where('kd_menu', $menu['kd_parent'])->get();
                if (count($cekParent) <= 0) {
                    Akses::create([
                        "user" => $user->user,
                        "kd_menu" => $menu['kd_parent'],
                    ]);
                }
                Akses::create([
                    "user" => $user->user,
                    "kd_menu" => $request->akses[$i],
                ]);
            }
        }

        Alert::success('Success!', 'Data User Updated!');
        return Redirect::to('/user');
    }

    public function delete(User $user)
    {
        $user->delete();
        DB::table('akses')
            ->where('user', $user->user)
            ->delete();
        Alert::success('Success!', 'Data User Deleted!');
        return Redirect::to('/user');
    }
}
