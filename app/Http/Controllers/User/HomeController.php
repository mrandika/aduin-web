<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Master\Report\Report;
use App\User;

class HomeController extends Controller
{
    public function index()
    {
        $reports = Report::active()->with(['user', 'instance', 'unit'])->get();
        return view('home')->with([
            'reports' => $reports
        ]);
    }
}
