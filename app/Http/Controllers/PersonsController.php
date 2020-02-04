<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
//
use App\Persons;

class PersonsController extends Controller {

    /**
     * @return View 2
     */
    public function home() {

        $persons = Persons::orderBy('id', 'DESC')->get();
        return View::make('home', array('persons' => $persons));
    }

    /**
     * @return View
     */
    public function persons() {

        $persons = Persons::orderBy('id', 'DESC')->get();
        return view('comment.persons', array('persons' => $persons));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'comment' => 'required',
        ]);

        $data = $request->all();
        Person::create_($data);
        return back()->with('success', 'Information sent successfully.');
    }

    /**
     * Add data to DB by Ajax 
     * @param Request $request
     * @return json
     */
    public function ajaxRequest(Request $request) {
        $error = '';
        $box = $request->all();


        $myValue = array();
        parse_str($box['form'], $myValue);
        if (!empty($myValue['comment'])) {
            Persons::create_($myValue);
        } else {
            if ($request->flow != 'view') {
                $error = 'error';
            }
        }

        $persons = Persons::orderBy('id', 'DESC')->take(Persons::LIMIT)->get();
        $countPersons = Persons::get();


        return response()->json([
                    'personsJson1' => view('comment.ajaxTable1')->with('persons', $persons)->render(),
                    'countPersonsJson' => view('comment.countPersons')->with('personQty', $countPersons->count())->render(),
                    'personsError' => view('comment.ajaxTableError')->with('error', $error)->render()
        ]);
    }

    public function destroy(Request $request) {

        $delete = $request->all();
        $personsObj = Persons::find($delete['id']);
        $personsObj->delete();

        $persons = Persons::orderBy('id', 'ASC')->take(Persons::LIMIT)->get();
        $countPersons = Persons::get();

        return response()->json([
                    'personsJson1' => view('comment.ajaxTable1')->with('persons', $persons)->render(),
                    'countPersons' => view('comment.countPersons')->with('personQty', $countPersons->count())->render()
        ]);
    }

}
