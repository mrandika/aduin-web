<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinishedReportExport;
use App\Model\Master\Report\Report;
use App\Model\Master\Instance\InstanceHandler;

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
            'count' => $this->_getReportCounts(),
        ]);
    }

    public function index_unhandled()
    {
        $handlers = InstanceHandler::with('user')->get();
        $reports = Report::active()->unhandled()->get();

        return view('admin/report/index')->with([
            'data' => 'unhandled',
            'handlers' => $handlers,
            'reports' => $reports
        ]);
    }

    public function index_handled()
    {
        $handlers = InstanceHandler::with('user')->get();
        $reports = Report::active()->handled()->get();

        return view('admin/report/index')->with([
            'data' => 'handled',
            'handlers' => $handlers,
            'reports' => $reports
        ]);
    }

    public function index_finished()
    {
        $handlers = InstanceHandler::with('user')->get();
        $reports = Report::active()->resolved()->get();

        return view('admin/report/index')->with([
            'data' => 'finished',
            'handlers' => $handlers,
            'reports' => $reports
        ]);
    }

    public function show($id)
    {
        $report = Report::find($id);

        return view('admin/report/show')->with([
            'report' => $report
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
