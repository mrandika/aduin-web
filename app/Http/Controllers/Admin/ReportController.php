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
        return [
            'unhandled' => Report::active()->unhandled()->count(),
            'handled' => Report::active()->handled()->count(),
            'finished' => Report::active()->resolved()->count(),
            'total' => Report::active()->count()
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
        $reports = Report::active()->unhandled()->newest()->get();

        return view('admin/report/index')->with([
            'data' => 'unhandled',
            'handlers' => $handlers,
            'reports' => $reports
        ]);
    }

    public function index_handled()
    {
        $reports = Report::active()->handled()->newest()->get();

        return view('admin/report/index')->with([
            'data' => 'handled',
            'reports' => $reports
        ]);
    }

    public function index_finished()
    {
        $reports = Report::active()->resolved()->newest()->get();

        return view('admin/report/index')->with([
            'data' => 'finished',
            'reports' => $reports
        ]);
    }

    public function search(Request $request)
    {
        $code = $request->post('code');
        $report = Report::relation()->searchCode($code);

        return redirect(action('Admin\ReportController@show', $report->id));
    }

    public function show($id)
    {
        $report = Report::relation()->id($id);

        return view('admin/report/show')->with([
            'report' => $report
        ]);
    }

    public function update(Request $request, $id)
    {
        $type = $request->post('type');
        $state = $request->post('state');

        if ($type == 'update_status') {
            $report = Report::find($id);
            $report->status = $state;
            $report->save();
        }

        return response()->json([
            'code' => 200,
            'message' => 'OK'
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
