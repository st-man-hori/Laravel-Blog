<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

final class DashboardController extends Controller
{
    /**
     * ダッシュボード
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}
