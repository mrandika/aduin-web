<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\Report;
use App\Model\Master\Report\ReportSupport;
use Auth;

class ReportController extends Controller
{
    public function support_report($id)
    {
        $support = new ReportSupport;
        $support->reports_id = $id;
        $support->users_id = Auth::id();
        $support->save();

        return response()->json($support);
    }

    public function unsupport_report($id)
    {
        $support = ReportSupport::where(['reports_id' => $id, 'users_id' => Auth::id()])->first();
        $support->delete();

        return response()->json($support);
    }

    public function search(Request $request)
    {
        $keyword = $request->post('keyword');
        $reports = Report::active()->newest()->relation()->searchQuery($keyword)->get();

        $instances = Instance::all();
        $newreportfinish = Report::resolved()->relation()->take(5)->orderBy('updated_at', 'desc')->get();

        return view('home')->with([
            'mode' => 'search',
            'reports' => $reports,
            'instances' => $instances,
            'finishnew' => $newreportfinish
            // 'units' => $units,
        ]);

        dd($reports);
    }

    /**
     * Store the reports to Database
     *
     * @param $id
     * @method GET
     */
    public function show($id)
    {
        $report = Report::relation()->id($id);

        return view('report/show')->with([
            'report' => $report
        ]);
    }

    /**
     * Store the reports to Database
     *
     * @param Request
     * @method POST
     */
    public function store(Request $request)
    {
        $instance_id = $request->post('instance_id');
        $title = $request->post('title');
        $content = $request->post('content');

        $report = new Report;
        $report->users_id = Auth::id();
        $report->instances_id = $instance_id ?? null;
        $report->title = $title;
        $report->content = $content;
        $report->save();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Update the reports
     *
     * @param Request, $id
     * @method UPDATE/PATCH
     */
    public function update(Request $request, $id)
    {
        $title = $request->post('title');
        $content = $request->post('content');

        $report = Report::find($id);

        if (Auth::id() != $report->users_id) {
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden'
            ], 403);
        }

        $report->title = $title;
        $report->content = $content;
        $report->save();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Delete the reports from Database
     *
     * @param $id
     * @method DELETE
     */
    public function destroy($id)
    {
        $report = Report::find($id);

        if (Auth::id() != $report->users_id) {
            return response()->json([
                'code' => 403,
                'message' => 'Forbidden'
            ], 403);
        }

        $report->delete();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }
}
