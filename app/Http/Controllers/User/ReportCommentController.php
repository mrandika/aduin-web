<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\ReportComment;
use Auth;

class ReportCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $report_id = $request->post('report_id');
        $content = $request->post('content');

        $comment = new ReportComment;
        $comment->reports_id = $report_id;
        $comment->users_id = Auth::id();
        $comment->content = $content;
        $comment->save();

        return response()->json([
            'code' => 200,
            'status' => 'OK' 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $content = $request->post('content');

        $comment = ReportComment::find($id);

        if (Auth::id() != $comment->users_id) {
            return response()->json([
                'code' => 403,
                'status' => 'Forbidden'
            ], 403);
        }

        $comment->content = $content;
        $comment->save();

        return response()->json([
            'code' => 200,
            'status' => 'OK'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = ReportComment::find($id);
        $comment->delete();
        
        if (Auth::id() != $comment->users_id) {
            return response()->json([
                'code' => 403,
                'status' => 'Forbidden'
            ], 403);
        }
        
        return response()->json([
            'code' => 200,
            'status' => 'OK'
        ]);
    }
}
