<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $q = null; 
        
        if ($request->has('q')) $q = $request->query('q');

        $auth_user_id = Auth::user()->id;
        
        $role = (new FileController)->roles($auth_user_id);
       
        $status = (new FileController)->actionStatus($role);

        if (empty($status)) {
            $status = [0, 0];
        }

        if ($role == "Administrator" || $role == "CRM") {
            $files = (new FileController)->indexQueryFilter($q);
        } else if ($role == "Assignor") {
            $status = (new FileController)->actionStatus($role);
            $q = $status[0];
            $files = (new FileController)->indexFilter($q);

            $location = "";
            $users = (new FileController)->fieldusers($location);
            

            return view('home')->with([
                'files' => $files,
                'users' => $users,
                'role' => $role
            ]);
        } else {
            $files = (new FileController)->indexUserFilter($auth_user_id, $status, $q);
        }


        return view('home')->with([
            'files' => $files,
            'role' => $role,
        ]);
    }
}
