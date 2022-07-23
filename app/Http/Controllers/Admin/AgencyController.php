<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AgencyController extends Controller
{
    public function index()
    {
        $agencies = User::where('role_id', 4)->get();

        return view('admin.agency.index', [
            'agencies' => $agencies
        ]);
    }
}