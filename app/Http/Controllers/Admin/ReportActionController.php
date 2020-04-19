<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\ReportAction;

class ReportActionController extends Controller
{
    public function store(Request $request)
    {
        $report_id = $request->post('report_id');
        $content = $request->post('content');

        $comment = new ReportAction;
        $comment->reports_id = $report_id;
        $comment->users_id = Auth::id();
        $comment->content = $content;
        $comment->save();

        return response()->json([
            'code' => 200,
            'status' => 'OK' 
        ]);
    }
}
