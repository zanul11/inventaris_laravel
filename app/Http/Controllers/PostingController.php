<?php

namespace App\Http\Controllers;

use App\Absen;
use App\JamKerja;
use App\Libur;
use App\Pegawai;
use App\Posting;
use App\TidakHadir;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class PostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->put('parent', 'Laporan Absen');
        $request->session()->put('child', 'Posting Absen');

        return view('pages.posting.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $rep_date = str_replace(" ", "", $request->waktu);
        $exp_date = explode("s/d", $rep_date);

        $startTimeStamp = strtotime($exp_date[0]);
        $endTimeStamp = strtotime($exp_date[1]);

        $timeDiff = abs($endTimeStamp - $startTimeStamp);

        $numberDays = $timeDiff / 86400;  // 86400 seconds in one day

        // and you might want to convert to integer
        $numberDays = intval($numberDays);

        $pegawai = Pegawai::where('is_absen', 1)->get();

        for ($i = 0; $i <= $numberDays; $i++) {
            $getHari = date('w', strtotime("+" . $i . " day", strtotime($exp_date[0])));
            $getTgl = date('Y-m-d', strtotime("+" . $i . " day", strtotime($exp_date[0])));
            $cekHariKerja = JamKerja::where('hari', $getHari)->first();
            if ($cekHariKerja['status'] == 'Tidak') { //libur Jam kerja
                foreach ($pegawai as $peg) {
                    Posting::where('tgl', $getTgl)->where('pegawai_id', $peg->id)->delete();
                    Posting::create([
                        "pegawai_id" => $peg->id,
                        "tgl" => $getTgl,
                        "hari" => $this->getNamaHari($getHari),
                        "jam_masuk" => $cekHariKerja['jam_masuk'],
                        "jam_pulang" => $cekHariKerja['jam_pulang'],
                        "tidak_masuk" => 'Hari Libur',
                        "keterangan" => $this->getNamaHari($getHari),
                        "is_masuk" => 0,
                    ]);
                }
            } else { //MAsuk jam kerja
                $cekLibur = Libur::whereDate('tgl_mulai', '<=', $getTgl)->whereDate('tgl_akhir', '>=', $getTgl)->first(); //cek libur
                foreach ($pegawai as $peg) {
                    Posting::where('tgl', $getTgl)->where('pegawai_id', $peg->id)->delete();
                    if ($cekLibur) { //hari lubur nasional
                        Posting::create([
                            "pegawai_id" => $peg->id,
                            "tgl" => $getTgl,
                            "hari" => $this->getNamaHari($getHari),
                            "jam_masuk" => $cekHariKerja['jam_masuk'],
                            "jam_pulang" => $cekHariKerja['jam_pulang'],
                            "tidak_masuk" => 'Hari Libur',
                            "keterangan" => $cekLibur['ket'],
                            "is_masuk" => 0,
                        ]);
                    } else { //masuk jam kerja 
                        $cekTidakMasukPegawai = TidakHadir::with('jenis')->whereDate('tgl_mulai', '<=', $getTgl)->whereDate('tgl_akhir', '>=', $getTgl)->where('pegawai_id', $peg->id)->first(); //cekTidakMasukPegawai
                        if ($cekTidakMasukPegawai) { //tidak masuk karena izin/sakit/dll
                            if ($cekTidakMasukPegawai['jenis']['status'] == 'Tidak') { //izin tidak DInas
                                Posting::create([
                                    "pegawai_id" => $peg->id,
                                    "tgl" => $getTgl,
                                    "hari" => $this->getNamaHari($getHari),
                                    "jam_masuk" => $cekHariKerja['jam_masuk'],
                                    "jam_pulang" => $cekHariKerja['jam_pulang'],
                                    "tidak_masuk" => $cekTidakMasukPegawai['jenis']['jenis'],
                                    "keterangan" => $cekTidakMasukPegawai['ket'],
                                    "is_masuk" => 2,
                                ]);
                            } else { //izin termasuk  DInas
                                Posting::create([
                                    "pegawai_id" => $peg->id,
                                    "tgl" => $getTgl,
                                    "hari" => $this->getNamaHari($getHari),
                                    "jam_masuk" => $cekHariKerja['jam_masuk'],
                                    "jam_pulang" => $cekHariKerja['jam_pulang'],
                                    "absen_masuk" => $cekHariKerja['jam_masuk'],
                                    "absen_pulang" => $cekHariKerja['jam_pulang'],
                                    "tidak_masuk" => $cekTidakMasukPegawai['jenis']['jenis'],
                                    "keterangan" => $cekTidakMasukPegawai['ket'],
                                    "is_masuk" => 1,
                                ]);
                            }
                        } else { //absen masuk
                            $getKehadiranMasuk = Absen::whereDate('tgl', $getTgl)->where('pegawai_id', $peg->id)->where('jenis', 1)->orderby('tgl')->first();
                            $getKehadiranPulang = Absen::whereDate('tgl', $getTgl)->where('pegawai_id', $peg->id)->where('jenis', 0)->orderby('tgl')->first();
                            if (!$getKehadiranMasuk && !$getKehadiranPulang) { //jika tidak absen bolos
                                Posting::create([
                                    "pegawai_id" => $peg->id,
                                    "tgl" => $getTgl,
                                    "hari" => $this->getNamaHari($getHari),
                                    "jam_masuk" => $cekHariKerja['jam_masuk'],
                                    "jam_pulang" => $cekHariKerja['jam_pulang'],
                                    "tidak_masuk" => 'Tidak Absen',
                                    "keterangan" => 'Tanpa Keterangan',
                                    "is_masuk" => 3,
                                ]);
                            } else {
                                Posting::create([
                                    "pegawai_id" => $peg->id,
                                    "tgl" => $getTgl,
                                    "hari" => $this->getNamaHari($getHari),
                                    "jam_masuk" => $cekHariKerja['jam_masuk'],
                                    "jam_pulang" => $cekHariKerja['jam_pulang'],
                                    "absen_masuk" => (!$getKehadiranMasuk) ? null : date('H:i:s', strtotime($getKehadiranMasuk['tgl'])),
                                    "absen_pulang" => (!$getKehadiranPulang) ? null : date('H:i:s', strtotime($getKehadiranPulang['tgl'])),
                                    "is_masuk" => 1,
                                    "telat" => (!$getKehadiranMasuk) ? 1 : ((date('H:i:s', strtotime($getKehadiranMasuk['tgl'])) > date('H:i:s', strtotime($cekHariKerja['jam_masuk']))) ? 1 : 0),
                                    "pulang_cepat" => (!$getKehadiranPulang) ? 1 : ((date('H:i:s', strtotime($getKehadiranPulang['tgl'])) < date('H:i:s', strtotime($cekHariKerja['jam_pulang']))) ? 1 : 0),
                                ]);
                            }
                        }
                    }
                }
            }
        }
        Alert::success('Success!', 'Berhasil Posting Absen!');
        return Redirect::to('/posting');
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

    public function getNamaHari($hari)
    {
        switch ($hari) {
            case 1:
                return "Senin";
                break;
            case 2:
                return "Selasa";
                break;
            case 3:
                return "Rabu";
                break;
            case 4:
                return "Kamis";
                break;
            case 5:
                return "Jumat";
                break;
            case 6:
                return "Sabtu";
                break;
            default:
                return "Minggu";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
