<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class NinesectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        return view('ninesection.show');
    }
}