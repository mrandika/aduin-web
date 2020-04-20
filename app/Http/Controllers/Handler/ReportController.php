<?php

namespace App\Http\Controllers\Handler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\Report;
use App\Model\Master\Instance\InstanceHandler;

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
        return view('handler/home')->with([
            'count' => $this->_getReportCounts(),
        ]);
    }

    public function index_handled()
    {
        $handlers = InstanceHandler::with('user')->get();
        $reports = Report::active()->handled()->get();

        return view('handler/report/index')->with([
            'data' => 'handled',
            'handlers' => $handlers,
            'reports' => $reports
        ]);
    }

    public function index_finished()
    {
        $handlers = InstanceHandler::with('user')->get();
        $reports = Report::active()->resolved()->get();

        return view('handler/report/index')->with([
            'data' => 'finished',
            'handlers' => $handlers,
            'reports' => $reports
        ]);
    }
}
