<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $data = [];
    public function index(Request $request) {
        $data['title'] = 'Dashboard';
        return view('admin.dashboard', [
            'datas' => $data
        ]);
    }
}
