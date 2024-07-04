<?php

namespace App\Imports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportColis implements FromView
{
    private $colis = null;

    public function  __construct($colis)
    {
        $this->colis = $colis;
    }

    public function view(): View
    {
        return view('export.colis', ['colis' => $this->colis]);
    }
}
