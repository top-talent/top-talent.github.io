<?php

namespace App\Http\Controllers;

class WelcomeController extends Controller
{
    /**
     * Returns the welcome page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('welcome.index');
    }
}
