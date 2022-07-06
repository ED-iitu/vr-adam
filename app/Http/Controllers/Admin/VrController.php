<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class VrController extends Controller
{
    public function vrList()
    {
        return view('admin.vr.index');
    }
}