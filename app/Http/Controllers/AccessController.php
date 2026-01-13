<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessController extends Controller
{
    public function index()
    {
        return view('access');
    }

    public function check(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        if ($request->code !== env('ACCESS_CODE')) {
            return back()->withErrors([
                'code' => 'Access code salah'
            ]);
        }

        session(['access_granted' => true]);

        return redirect()->route('login');
    }
}

