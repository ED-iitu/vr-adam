<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class ModerationController extends Controller
{
    public function identificationModerationList()
    {
        return view('admin.moderation.identification');
    }

    public function vrModerationList()
    {
        return view('admin.moderation.vr');
    }
}