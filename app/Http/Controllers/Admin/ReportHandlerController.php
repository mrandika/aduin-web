<?php

namespace App\Http\Controllers\Admin;

use Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Report\Report;
use App\Model\Master\Report\ReportHandler;
use App\Model\Master\Report\ReportAction;

class ReportHandlerController extends Controller
{
    public function store(Request $request)
    {
        $report_id = $request->post('report_id');

        foreach ($request->handlers as $handler_id) {
            $handler = new ReportHandler;
            $handler->reports_id = $report_id;
            $handler->instance_handlers_id = $handler_id;
            $handler->save();
        }

        $action = new ReportAction;
        $action->reports_id = $report_id;
        $action->users_id = Auth::id();

        $operator_name = Auth::user()->first_name.' '.Auth::user()->last_name;

        $action->content = "Halo, nama saya $operator_name. Saya telah meninjau laporan anda dan telah mengerahkan petugas untuk mengecek kondisi yang telah dilaporkan. Proses ini akan memakan waktu 3-5 hari kerja. Untuk itu, kami mohon untuk menunggu kelanjutan yang akan dilaporkan petugas.";
        $action->save();

        $report = Report::find($handler->reports_id);
        $report->status = 2;
        $report->save();

        return response()->json([
            'code' => 200,
            'message' => 'OK'
        ]);
    }
}
