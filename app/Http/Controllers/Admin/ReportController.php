<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinishedReportExport;
use App\Model\Master\Report\Report;

use QrCode;

class ReportController extends Controller
{
    public function _getReportCounts() 
    {
        $report = Report::active();

        return [
            'unhandled' => $report->unhandled()->count(),
            'handled' => $report->handled()->count(),
            'finished' => $report->resolved()->count(),
            'total' => $report->count()
        ];
    }

    public function index() 
    {
        return view('admin/home')->with([
            'count' => $this->_getReportCounts()
        ]);
    }

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

    public function generate_qr()
    {
        return view('admin/qrcode');
    }
}
