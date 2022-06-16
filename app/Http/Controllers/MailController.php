<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {

        $details = [
            'title' => 'Konfirmasi Pengeluaran',
            'body' => 'Memerlukan Konfirmasi Pengeluaran Anda!'
        ];

        \Mail::to('zanul17@gmail.com')->send(new MyTestMail($details));

        dd("Email sudah terkirim.");
    }
}
