<?php

namespace App\Http\Controllers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;

class generateQRCode extends Controller
{
    public function generateQRCode()
    {
        // Генерируем QR-код с текстом "Hello, World!"
        $qrCode = QrCode::size(100)->generate('Hello, World!');

        // Возвращаем представление с QR-кодом
        return view('qrcode', compact('qrCode'));
    }
}
