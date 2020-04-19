<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\ReportComment;
use Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$comment = ReportComment::relation()->id($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        

        return response()->json([
            'code' => 200,
            'status' => 'OK'
        ]);
    }
}
