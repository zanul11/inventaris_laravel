<?php

namespace App\Http\Controllers;

use App\Mail\MyTestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function index()
    {

        return view('pages.email_page');
    }

    public function store(Request $request)
    {
        // return $request;
        $details = [
            'title' => 'Konfirmasi Pengeluaran',
            'body' => 'Memerlukan Konfirmasi Pengeluaran Anda!'
        ];

        \Mail::to('zanul17@gmail.com')->send(new MyTestMail($details));

        dd("Email sudah terkirim.");
    }
}
