<?php

namespace App\Exports;

use App\Report;
use Maatwebsite\Excel\Concerns\FromCollection;

class FinishedReportExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View {
        return view('admin/export', [
            'reports' => Report::relation()->resolved()->get()
        ]);
    }
}
