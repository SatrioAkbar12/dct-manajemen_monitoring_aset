<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:aset.index|aset.detail');
    }

    public function index() {
        $data_aset = Aset::paginate(10);

        return view('aset.index', ['data_aset' => $data_aset]);
    }

    public function detail($id) {
        $data_aset = Aset::find($id);

        return view('aset.detail', ['data_aset' => $data_aset]);
    }
}
