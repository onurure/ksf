<?php

namespace App\Exports;

use App\SafeData;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('report.table', [
            'datas' => $this->data
        ]);
    }
}
