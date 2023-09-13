<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StatistikPeminjamanUserController extends Controller
{
    public function __construct()
    {
        return $this->middleware('permission:reporting.statistikPeminjamanUser.index');
    }

    public function index()
    {
        $data_user = User::paginate(20);

        return view('reporting.statistikPerminjamanUser.index', ['data_user' => $data_user]);
    }
}
