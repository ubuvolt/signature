<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,
    Redirect,
    Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Session;
use App\CentralSetting;

class AuthController extends Controller {

    public function index() {
        return view('login');
    }

    public function registration() {
        return view('registration');
    }

    /**
     * @param Request $request
     * 
     * @return type
     */
    public function postLogin(Request $request) {

        request()->validate([
            'email' => 'required',
            'password' => 'required|min:2',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $settingsPdfReport = Auth::user()->getSettings(CentralSetting::E_SIGNATURE);
            
            $signatute_status = DB::Table('users')->select('signature')->where('id', Auth::user()->id)->first();

            if ($signatute_status->signature) {

                $controller = new ReportController;
                $signature = $controller->getLastSignatureArray(Auth::user()->id);

                $signature = $signature[0];
            } else {
                $signature = 0;
            }

            return view('dashboard', [
                'signature' => $signature,
                'settingsPdfReport' => $settingsPdfReport,
            ]);
        }

        return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
    }

    public function postRegistration(Request $request) {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);


        $data = $request->all();

        $check = $this->create($data);

        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function dashboard() {

        if (Auth::check()) {

//            $controller = new ReportController;
//            $report = $controller->getLastSignatureArray(Auth::user()->id);

            return view('dashboard', [
//                'signature' => $report[0],
            ]);


        }
        return Redirect::to("login")->withSuccess('Successful registration');
    }

    public function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password'])
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }

}
