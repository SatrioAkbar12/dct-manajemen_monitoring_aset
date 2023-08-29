<?php

namespace App\Http\Controllers;

use App\Http\Requests\FirstLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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
    public function index()
    {
        $auth = Auth::user();

        if($auth->first_login == 1) {
            return view('renewPassword');
        }

        return view('firstLogin');
    }

    public function firstLogin(FirstLoginRequest $request) {
        $auth = Auth::id();

        User::where('id', $auth)->update([
            'password' => Hash::make($request->password),
            'first_login' => 0
        ]);

        Alert::success('Tersimpan!', 'Berhasil memperbarui password');

        return redirect(route('home'));
    }
}
