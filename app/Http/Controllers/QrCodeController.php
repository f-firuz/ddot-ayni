<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    
    public function generateQrCode()
    {
        $qrCode = QrCode::size(300)->generate('https://example.com');

        return view('qrcode', compact('qrCode'));
    }

}
