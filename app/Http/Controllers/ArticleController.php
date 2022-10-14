<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Quote;
use App\Models\SquareBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    protected $data = [];

    public function index(Request $request) {
        $this->data['title'] = "Article's";
        $this->data['desc'] = "Simple minded people do things like gossip, lie, spread rumors, and cause troubles. But, I know you're more intelligent.";
        $this->data['squareBanners'] = SquareBanner::all();
        $this->data['quotes'] = Quote::inRandomOrder()->limit(5)->get();
        $this->data['article'] = Article::where('type', 'project')->where('status', 'publish')->inRandomOrder()->limit(3)->get();

        $randNumber = rand(0,100);
        if($randNumber <= 33) {
            $this->data['randNumber'] = 3;
        }else if($randNumber <= 66) {
            $this->data['randNumber'] = 4;
        }else{
            $this->data['randNumber'] = 5;
        }

        if($request->query('search') ?? false) {
            if($request->query('search') != ''){
                $this->data['articles'] = Article::where('type', 'article')->where('status', 'publish')->where('title', 'LIKE', '%' . $request->query('search') . '%')->orWhere('description', 'LIKE', '%' . $request->query('search') . '%')->orWhere('body', 'LIKE', '%' . $request->query('search') . '%')->orderBy('created_at', 'desc')->paginate(10);
            }else{
                $this->data['articles'] = Article::where('type', 'article')->where('status', 'publish')->orderBy('created_at', 'desc')->paginate(10);
            }
        }else{
            $this->data['articles'] = Article::where('type', 'article')->where('status', 'publish')->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('layout.layout-articles', [
            'datas' => $this->data
        ]);
    }

    public function getArticle(Request $request, $slug) {
        $article = Article::where('slug', $slug)->where('type', 'article')->where('status', 'publish')->first();

        if(!$article) {
            return redirect('/articles');
        }

        if(!Auth::check()){
            $article->view = $article->view + 1;
            $article->timestamps = false;
            $article->save();
        }

        $this->data['title'] = $article->title;
        $this->data['article'] = Article::where('slug', $slug)->where('type', 'article')->where('status', 'publish')->first();
        $this->data['squareBanners'] = SquareBanner::all();
        $this->data['quotes'] = Quote::inRandomOrder()->limit(5)->get();
        $this->data['articles'] = Article::where('type', 'project')->where('status', 'publish')->inRandomOrder()->limit(3)->get();

        $randNumber = rand(0,100);
        if($randNumber <= 33) {
            $this->data['randNumber'] = 3;
        }else if($randNumber <= 66) {
            $this->data['randNumber'] = 4;
        }else{
            $this->data['randNumber'] = 5;
        }

        return view('show-article', [
            'datas' => $this->data
        ]);
    }
}
