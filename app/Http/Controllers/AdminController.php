<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Quote;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $data = [];
    public function index(Request $request) {
        $this->data['title'] = 'Dashboard';
        $this->data['articles'] = Article::where('type','article')->where('status', 'publish')->count();
        $this->data['projects'] = Article::where('type', 'project')->where('status', 'publish')->count();
        $this->data['quotes'] = Quote::all()->count();
        $this->data['products'] =  Product::all()->count();
        $this->data['gallery'] = Photo::all()->count();
        $this->data['draft'] = Article::where('status', 'draft')->count();

        return view('admin.dashboard', [
            'datas' => $this->data
        ]);
    }
}
