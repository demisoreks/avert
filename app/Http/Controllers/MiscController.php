<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class MiscController extends Controller
{
    public function guards(Request $request) {
        $input = $request->input();
        if (isset($input['region'])) {
            $region = $input['region'];
        } else {
            $region = DB::table('tmp_guards')->distinct('region')->orderBy('region')->first()->region;
        }
        $guards = DB::table('tmp_guards')->where('region', $region)->get();
        $search_param = [
            'region' => $region
        ];
        return view('misc.guards', compact('guards', 'search_param'));
    }
}
