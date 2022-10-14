<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Quote;
use App\Models\SquareBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    protected $data = [];

    public function index(Request $request){
        $this->data['title'] = "Project's";
        $this->data['desc'] = 'Let our advance worrying become advance thinking and planning.';

        $this->data['squareBanners'] = SquareBanner::all();
        $this->data['quotes'] = Quote::inRandomOrder()->limit(5)->get();
        $this->data['article'] = Article::where('type', 'article')->where('status', 'publish')->inRandomOrder()->limit(3)->get();

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
                $this->data['articles'] = Article::where('type', 'project')->where('status', 'publish')->where('title', 'LIKE', '%' . $request->query('search') . '%')->orWhere('description', 'LIKE', '%' . $request->query('search') . '%')->orWhere('body', 'LIKE', '%' . $request->query('search') . '%')->orderBy('created_at', 'desc')->paginate(10);
            }else{
                $this->data['articles'] = Article::where('type', 'project')->where('status', 'publish')->orderBy('created_at', 'desc')->paginate(10);
            }
        }else{
            $this->data['articles'] = Article::where('type', 'project')->where('status', 'publish')->orderBy('created_at', 'desc')->paginate(10);
        }
        return view('layout.layout-articles', [
            'datas' => $this->data
        ]);
    }

    public function getProject(Request $request, $slug) {
        $project = Article::where('slug', $slug)->where('type', 'project')->where('status', 'publish')->first();

        if(!$project) {
            return redirect('/projects');
        }

        if(!Auth::check()){
            $project->view = $project->view + 1;
            $project->timestamps = false;
            $project->save();
        }

        $this->data['title'] = $project->title;
        $this->data['article'] = Article::where('slug', $slug)->where('type', 'project')->where('status', 'publish')->first();
        $this->data['squareBanners'] = SquareBanner::all();
        $this->data['quotes'] = Quote::inRandomOrder()->limit(5)->get();
        $this->data['articles'] = Article::where('type', 'article')->where('status', 'publish')->inRandomOrder()->limit(3)->get();

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
