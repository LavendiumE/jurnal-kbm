<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function jurnal()
    {
        return view('jurnal');
    }
}
