<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\View;

class GeneratePdfController extends Controller
{
    public function NonCompetitiveBidForm()
    {
        $data = [
            'title' => 'Sample PDF',
            'content' => 'This is the content of the PDF file.',
        ];

        $pdf = PDF::loadView('pdf/pdf_non_competitive_bid_form', compact('data'));

        return $pdf->download('competitive-bid.pdf');
        // return view('pdf/pdf_non_competitive_bid_form'); 
    }
    public function ijaraSukukDetail()
    {
        $image=public_path('theme/assets/images/AKD-LOGO.png');
        $data = [
            'title' => 'Sample PDF',
            'image' => $image,
        ];
        $pdf = PDF::loadView('pdf/ijara_sukuk_detail', compact('data'));

        return $pdf->download('Ijara-Sukuk-Term-Sheet.pdf');
        // return view('pdf/ijara_sukuk_detail', compact('data')); 
    }
}
