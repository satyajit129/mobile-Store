<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function AdminDashboard(){
        return view('admin.pages.dashboard.dashboard');
    }
    public function adminSettings(){
        dd('ok');
    }
}
