<?php

namespace App\Http\Controllers;

use App\AdmSiswa;
use Illuminate\Http\Request;
use App\Gelombang;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Redirect;
use App\Siswa;
use App\Jurusan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Pegawai;

class DaftarUlangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Verifikasi');
        $request->session()->put('child', 'Daftar Ulang');
        $gelombang = Gelombang::where('dari', '<=', date('m'))->where('sampai', '>=', date('m'))->first();
        $siswa = Siswa::with('jurusan')->with(['daftar_ulang' => function ($query) {
            return $query->where('jenis', 'Daftar Ulang')->where('status', 0);
        }])->with(['adm' => function ($query) {
            return $query->where('jenis', 'Daftar Ulang')->where('status', 1);
        }])->whereYear('tgl_masuk', date('Y'))->where('gelombang', $gelombang->gelombang)->whereIn('status', [3, 4, 5])->get();
        // $jumlah_du = AdmSiswa::where('jenis_adm', 1)->whereIN('jenis', ['Daftar Ulang'])->sum('jumlah');
        // return $siswa;
        return view('pages.daftar_ulang.index', compact('siswa', 'gelombang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function cetak()
    {

        $pegawai = Pegawai::where('jabatan', 10000)->first();
        $gelombang = Gelombang::where('dari', '<=', date('m'))->where('sampai', '>=', date('m'))->first();
        // $siswa = Siswa::with('jurusan')->with(['daftar_ulang' => function ($query) {
        //     $query->where('jenis', 'Daftar Ulang');
        // }])->whereYear('tgl_masuk', date('Y'))->where('gelombang', $gelombang->gelombang)->whereIn('status', [3, 4, 5])->get();
        $siswa = Siswa::with('jurusan')->with(['daftar_ulang' => function ($query) {
            return $query->where('jenis', 'Daftar Ulang')->where('status', 0);
        }])->with(['adm' => function ($query) {
            return $query->where('jenis', 'Daftar Ulang')->where('status', 1);
        }])->whereYear('tgl_masuk', date('Y'))->where('gelombang', $gelombang->gelombang)->whereIn('status', [3, 4, 5])->get();
        return view('cetak.data_daftarulang', compact('siswa', 'gelombang', 'pegawai'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $daftar_ulang)
    {

        $siswa = $daftar_ulang;
        $jurusan = Jurusan::where('status', '1')->get();
        return view('pages.daftar_ulang.detail', compact('siswa', 'jurusan'));
    }

    public function verif(Request $request)
    {
        $tgl = date('Y-m-d');
        $siswa = Siswa::where('no_induk', $request->no_induk)->first();
        $adm = AdmSiswa::where('siswa_induk', $request->no_induk)->where('jenis', 'Daftar Ulang')->get();
        $total_daftar_ulang = 0;
        foreach ($adm as $dt) {
            $total_daftar_ulang += $dt->jumlah;
        }
        if (($siswa->jumlah_du - $total_daftar_ulang) > 0) {
            DB::table('siswas')
                ->where('no_induk', $request->no_induk)
                ->update(["status" => 3]);
        } else {
            DB::table('siswas')
                ->where('no_induk', $request->no_induk)
                ->update(["status" => 5]);
        }

        DB::table('adm_siswa')
            ->where('siswa_induk', $request->no_induk)
            ->where('jenis', 'Daftar Ulang')->where('status', 0)
            ->update(["status" => 1, "updated_at" => $tgl, "user" => Auth::user()->user]);
        // $email = $siswa->email;
        // $data = array(
        //     'nama' => $siswa->nama,
        //     'ket' => 'Pembayaran dengan Transfer Bank',
        // );
        // Mail::send('email_daftar_ulang', $data, function ($mail) use ($email) {
        //     $mail->to($email, 'no-replay')
        //         ->subject("Verifikasi Pembayaran Daftar Ulang");
        //     $mail->from('dmesanggok@gmail.com', 'Verifikasi Daftar Ulang');
        // });
        // if (Mail::failures()) {
        //     toast('Gagal Mengirim Email Verfikasi!', 'success');
        // }
        $user = User::where('user', $request->no_induk)->first();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $msg = [
            'title' => 'Pembayaran Daftar Ulang Anda Diterima!',
            'body' => 'Pembayaran Daftar Ulang anda telah kami terima melalui pembayaran Transfer Bank',

        ];
        $extra = ["message" => $msg, "click_action" => "FLUTTER_NOTIFICATION_CLICK"];
        $fcm = [
            "to" => $user->notif_id,
            "notification" => $msg,
            "data" => $extra
        ];
        $headers = [
            'Authorization: key=	AAAAZZSDX9M:APA91bFpzlTGKKEnrLDEfSl1KiNQhFb9BWcolHCvEfjhA_rnWre-GydjXh4xZyHBOHaEw_41DS_wGh8YglG6mOTSXGiElsk_IWhRYt5ya4uXlnLF2m2MontmyYJrBFdSB7EwznNQA4EP',
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcm));
        $result = curl_exec($ch);
        curl_close($ch);
        $bayar = Siswa::with('jurusan')->where('status',  1)->whereYear('tgl_masuk', date('Y'))->orderBy('created_at')->count();
        $gelombang = Gelombang::where('dari', '<=', date('m'))->where('sampai', '>=', date('m'))->first();
        $daftar_ulang = Siswa::with('jurusan')->where('status',  4)->whereYear('tgl_masuk', date('Y'))->where('gelombang', $gelombang->gelombang)->orderBy('created_at')->count();
        $request->session()->put('daftar_ulang', $daftar_ulang);
        $request->session()->put('bayar', $bayar);
        $request->session()->put('total', $bayar + $daftar_ulang);
    }

    public function verifTolak(Request $request)
    {
        DB::table('siswas')
            ->where('no_induk', $request->no_induk)
            ->update(["status" => 3]);
        DB::table('adm_siswa')
            ->where('siswa_induk', $request->no_induk)
            ->where('jenis', 'Daftar Ulang')
            ->where('status', 0)
            ->delete();
        // $siswa = Siswa::where('no_induk', $request->no_induk)->first();
        // $email = $siswa->email;
        // $data = array(
        //     'nama' => $siswa->nama,
        //     'ket' => 'Pembayaran dengan Transfer Bank',
        // );
        // Mail::send('email_tolak', $data, function ($mail) use ($email) {
        //     $mail->to($email, 'no-replay')
        //         ->subject("Daftar Ulang Ditolak");
        //     $mail->from('dmesanggok@gmail.com', 'Pembayaran Daftar Ulang Ditolak');
        // });
        // if (Mail::failures()) {
        //     toast('Gagal Mengirim Email Verfikasi!', 'success');
        // }
        $user = User::where('user', $request->no_induk)->first();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $msg = [
            'title' => 'Pembayaran Daftar Ulang Anda Ditolak!',
            'body' => 'Pembayaran Daftar Ulang anda telah kami terima melalui pembayaran Langsung',

        ];
        $extra = ["message" => $msg, "click_action" => "FLUTTER_NOTIFICATION_CLICK"];
        $fcm = [
            "to" => $user->notif_id,
            "notification" => $msg,
            "data" => $extra
        ];
        $headers = [
            'Authorization: key=	AAAAZZSDX9M:APA91bFpzlTGKKEnrLDEfSl1KiNQhFb9BWcolHCvEfjhA_rnWre-GydjXh4xZyHBOHaEw_41DS_wGh8YglG6mOTSXGiElsk_IWhRYt5ya4uXlnLF2m2MontmyYJrBFdSB7EwznNQA4EP',
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcm));
        $result = curl_exec($ch);
        curl_close($ch);
        $bayar = Siswa::with('jurusan')->where('status',  1)->whereYear('tgl_masuk', date('Y'))->orderBy('created_at')->count();
        $gelombang = Gelombang::where('dari', '<=', date('m'))->where('sampai', '>=', date('m'))->first();
        $daftar_ulang = Siswa::with('jurusan')->where('status',  4)->whereYear('tgl_masuk', date('Y'))->where('gelombang', $gelombang->gelombang)->orderBy('created_at')->count();
        $request->session()->put('daftar_ulang', $daftar_ulang);
        $request->session()->put('bayar', $bayar);
        $request->session()->put('total', $bayar + $daftar_ulang);
    }

    public function verifLangsung(Request $request)
    {
        $tgl = date('Y-m-d');
        $siswa = Siswa::where('no_induk', $request->no_induk)->first();
        $adm = AdmSiswa::where('siswa_induk', $request->no_induk)->where('jenis', 'Daftar Ulang')->where('status', 1)->get();
        $total_daftar_ulang = preg_replace('/[^0-9]/', '', $request->jumlah);
        foreach ($adm as $dt) {
            $total_daftar_ulang += $dt->jumlah;
        }
        if (($siswa->jumlah_du - $total_daftar_ulang) > 0) {
            DB::table('siswas')
                ->where('no_induk', $request->no_induk)
                ->update([
                    "status" => 3, "waktu_du" => $tgl, "nama_du" => 'P4M',
                    "ket_du" => 'Langsung',
                ]);
        } else {
            DB::table('siswas')
                ->where('no_induk', $request->no_induk)
                ->update([
                    "status" => 5, "waktu_du" => $tgl, "nama_du" => 'P4M',
                    "ket_du" => 'Langsung',
                ]);
        }
        // DB::table('siswas')
        //     ->where('no_induk', $request->no_induk)
        //     ->update([
        //         "status" => 5, "waktu_du" => $tgl, "nama_du" => 'P4M',
        //         "ket_du" => 'Langsung',
        //     ]);
        DB::table('adm_siswa')
            ->insert([
                "siswa_induk" => $request->no_induk,
                "nama_transfer" => 'P4M',
                "bukti" => '-',
                "ket" => 'Langsung',
                "jenis" => 'Daftar Ulang',
                "status" => 1,
                "jumlah" => preg_replace('/[^0-9]/', '', $request->jumlah),
                "created_at" => $tgl
            ]);
        // $siswa = Siswa::where('no_induk', $request->no_induk)->first();
        // $email = $siswa->email;
        // $data = array(
        //     'nama' => $siswa->nama,
        //     'ket' => 'Pembayaran Langsung di P4M',
        // );
        // Mail::send('email_daftar_ulang', $data, function ($mail) use ($email) {
        //     $mail->to($email, 'no-replay')
        //         ->subject("Verifikasi Pembayaran Daftar Ulang");
        //     $mail->from('dmesanggok@gmail.com', 'Verifikasi Daftar Ulang');
        // });
        // if (Mail::failures()) {
        //     toast('Gagal Mengirim Email Verfikasi!', 'success');
        // }
        $user = User::where('user', $request->no_induk)->first();
        $url = 'https://fcm.googleapis.com/fcm/send';
        $msg = [
            'title' => 'Pembayaran Daftar Ulang Anda Diterima!',
            'body' => 'Pembayaran Daftar Ulang anda telah kami terima melalui pembayaran Langsung',

        ];
        $extra = ["message" => $msg, "click_action" => "FLUTTER_NOTIFICATION_CLICK"];
        $fcm = [
            "to" => $user->notif_id,
            "notification" => $msg,
            "data" => $extra
        ];
        $headers = [
            'Authorization: key=	AAAAZZSDX9M:APA91bFpzlTGKKEnrLDEfSl1KiNQhFb9BWcolHCvEfjhA_rnWre-GydjXh4xZyHBOHaEw_41DS_wGh8YglG6mOTSXGiElsk_IWhRYt5ya4uXlnLF2m2MontmyYJrBFdSB7EwznNQA4EP',
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcm));
        $result = curl_exec($ch);
        curl_close($ch);

        $bayar = Siswa::with('jurusan')->where('status',  1)->whereYear('tgl_masuk', date('Y'))->orderBy('created_at')->count();
        $gelombang = Gelombang::where('dari', '<=', date('m'))->where('sampai', '>=', date('m'))->first();
        $daftar_ulang = Siswa::with('jurusan')->where('status',  4)->whereYear('tgl_masuk', date('Y'))->where('gelombang', $gelombang->gelombang)->orderBy('created_at')->count();
        $request->session()->put('daftar_ulang', $daftar_ulang);
        $request->session()->put('bayar', $bayar);
        $request->session()->put('total', $bayar + $daftar_ulang);
        Alert::success('Success!', 'Data Pembayaran Berhasil Terverifikasi!');
        return Redirect::to('/daftar-ulang');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
