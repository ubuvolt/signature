<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//
use App\Persons;

class FormController extends Controller {

    public function create() {
        //
        return view('create');
    }

    public function store(Request $request) {

        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'comment' => 'required',
        ]);

        $data = $request->all();
        $check = Persons::create_($data);
        $arr = array('msg' => 'Something goes to wrong. Please try again lator', 'status' => false);
        if ($check) {
            $arr = array('msg' => 'Successfully submit form using ajax', 'status' => true);
        }
        return Response()->json($arr);
    }

}
