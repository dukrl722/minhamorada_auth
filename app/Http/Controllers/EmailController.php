<?php

namespace App\Http\Controllers;

use App\Mail\RecoverMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendMail() {
        Mail::to('dukrl222@hotmail.com')->send(new RecoverMail);

        if (Mail::failures() != 0) {
            return json_encode([
                'success' => true,
                'message' => 'O email foi enviado com sucesso.'
            ]);
        }

        return json_encode([
            'success' => false,
            'message' => 'Erro ao enviar o email.'
        ]);
    }
}
