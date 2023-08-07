<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function generatePDF()
    {

        $pdf = Pdf::loadView('pdf.surat-cuti');

        return $pdf->setPaper('A4', 'potrait')->download('testing.pdf');
    }
}
