<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\Report;
use Auth;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('people')->except('update_seen_count');
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

        return view('reports/show')->with([
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
        $unit_id = $request->post('unit_id');
        $title = $request->post('title');
        $content = $request->post('content');

        $report = new Report;
        $report->users_id = Auth::id();
        $report->instances_id = $instance_id ?? null;
        $report->instance_units_id = $unit_id ?? null;
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
        $report = Report::find($id)->delete();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }
}
