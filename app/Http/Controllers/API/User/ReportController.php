<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\Report;
use App\Model\Master\Report\ReportSupport;
use App\Model\Master\Report\ReportComment;
use Auth;

class ReportController extends Controller
{
    /**
     * Show all the reports
     *
     * @method GET
     */
    public function index()
    {
        $reports = Report::active()->newest()->relation()->get();

        return response()->json([
            'code' => 200,
            'message' => 'OK',
            'data' => $reports
        ]);
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

        return response()->json([
            'code' => 200,
            'message' => 'OK',
            'data' => $report
        ]);
    }

    /**
     * Store the supports to Database
     *
     * @param $id
     * @method POST
     */
    public function support($id)
    {
        $support = new ReportSupport;
        $support->reports_id = $id;
        $support->users_id = Auth::id();
        $support->save();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Destroy the supports from Database
     *
     * @param $id
     * @method DELETE
     */
    public function unsupport($id)
    {
        $support = ReportSupport::find($id);
        $support->delete();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Store the comments to Database
     *
     * @param Request, $id
     * @method POST
     */
    public function comment(Request $request, $id)
    {
        $content = $request->post('content');

        $comment = new ReportComment;
        $comment->reports_id = $id;
        $comment->users_id = Auth::id();
        $comment->content = $content;
        $comment->save();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }

    /**
     * Destroy the comments from Database
     *
     * @param Request, $id
     * @method DELETE
     */
    public function destroy_comment(Request $request, $id)
    {
        $comment = ReportComment::find($id);
        $comment->delete();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
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
