<?php

namespace App\Exports;

use App\Model\Master\Report\Report;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

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
