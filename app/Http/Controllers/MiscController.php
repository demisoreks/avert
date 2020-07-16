<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class MiscController extends Controller
{
    public function guards() {
        $guards = DB::table('tmp_guards')->get();
        return view('misc.guards', compact('guards'));
    }
}
