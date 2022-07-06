<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AgencyController extends Controller
{
    public function index()
    {
        return view('admin.agency.index');
    }
}