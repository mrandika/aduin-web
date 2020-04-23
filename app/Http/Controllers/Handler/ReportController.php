<?php

namespace App\Http\Controllers\Handler;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\Report;
use App\Model\Master\Instance\InstanceHandler;

use Auth;

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
        $reports = Report::active()->handled()->with('handlers')->newest()->get();
        $user = InstanceHandler::select('id')->where('users_id', Auth::id())->first()->id;

        $reports_by_user = [];

        foreach ($reports as $report) {
            foreach ($report->handlers as $handler) {
                if ($handler->instance_handlers_id == $user) {
                    $reports_by_user[] = $report->id;
                }
            }
        }

        $reports = Report::whereIn('id', $reports_by_user)->newest()->get();

        return view('handler/report/index')->with([
            'data' => 'handled',
            'reports' => $reports
        ]);
    }

    public function index_finished()
    {
        $reports = Report::active()->resolved()->with('handlers')->newest()->get();
        $user = InstanceHandler::select('id')->where('users_id', Auth::id())->first()->id;

        $reports_by_user = [];

        foreach ($reports as $report) {
            foreach ($report->handlers as $handler) {
                if ($handler->instance_handlers_id == $user) {
                    $reports_by_user[] = $report->id;
                }
            }
        }

        $reports = Report::whereIn('id', $reports_by_user)->get();

        return view('handler/report/index')->with([
            'data' => 'finished',
            'reports' => $reports
        ]);
    }

    public function search(Request $request)
    {
        $code = $request->post('code');
        $report = Report::relation()->searchCode($code);

        return redirect(action('Handler\ReportController@show', $report->id));
    }

    public function show($id)
    {
        $report = Report::relation()->id($id);

        return view('handler/report/show')->with([
            'report' => $report
        ]);
    }
}
