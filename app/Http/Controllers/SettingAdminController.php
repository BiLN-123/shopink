<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingAdminController extends Controller
{
    public function  index(){
        return view('admin.settings.index');
    }

    public function create(){
        return view('admin.settings.add');
    }
}
