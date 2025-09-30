<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $type = $request->input('type', 'day');
        $cashierName = $request->input('user_id', 'All');
        $date = $request->input('start_date', date('Y-m-d'));
    
        $orders = collect();
    
        return view('admin.dashboard.index');
    }
    
    
}
