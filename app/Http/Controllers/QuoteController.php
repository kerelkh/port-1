<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Quote;
use App\Models\SquareBanner;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    protected $data = [];

    public function index(Request $request){
        $this->data['title'] = 'Quotes';
        $this->data['desc'] = 'A sentence, thousand mean.';
        $this->data['squareBanners'] = SquareBanner::all();
        $this->data['articles'] = Article::where('status', 'publish')
        ->inRandomOrder()->limit(3)->get();

        $randNumber = rand(0,100);
        if($randNumber <= 33) {
            $this->data['randNumber'] = 3;
        }else if($randNumber <= 66) {
            $this->data['randNumber'] = 4;
        }else{
            $this->data['randNumber'] = 5;
        }

        if($request->query('search') != NULL || $request->query('search') != '') {
            $this->data['quotes'] = Quote::where('quote', 'LIKE', '%' . $request->query('search') . '%')->orWhere('name', 'LIKE', '%' . $request->query('search') . '%')->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $this->data['quotes'] = Quote::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('quote', [
            'datas' => $this->data,
        ]);
    }
}
