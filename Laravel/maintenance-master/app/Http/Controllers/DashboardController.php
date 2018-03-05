<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Displays the maintenance management dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard.index');
    }
}
