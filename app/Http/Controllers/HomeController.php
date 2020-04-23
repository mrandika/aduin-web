<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Model\Master\Instance\Instance;
use App\Model\Master\Instance\InstanceUnit;
use App\Model\Master\Report\Report;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $reports = Report::active()->newest()->relation()->paginate(15);
        $instances = Instance::all();
        $newreportfinish = Report::resolved()->relation()->take(5)->orderBy('updated_at', 'desc')->get();
        // $units = InstanceUnit::all();

        return view('home')->with([
            'mode' => 'index',
            'reports' => $reports,
            'instances' => $instances,
            'finishnew' => $newreportfinish
            // 'units' => $units,
        ]);
    }
}
