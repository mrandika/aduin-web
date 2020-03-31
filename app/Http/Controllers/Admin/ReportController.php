<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinishedReportExport;
use App\Model\Master\Report\Report;

class ReportController extends Controller
{
    public function report_export()
    {
        return Excel::download(new FinishedReportExport, 'Finish Report.xlsx');
    }

    public function report()
    {
        return view('admin/export', [
            'reports' => Report::relation()->resolved()->get()
        ]);
    }
}
