<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use App\Models\Log;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleManagementController extends Controller
{
    protected $data = [];

    public function index(Request $request) {
        $this->data['title'] = "Article's Management";

        return view('admin.articles', [
            'datas' => $this->data
        ]);
    }

    public function getArticle(Request $request, $slug) {
        $article = Article::where('slug', $slug)->first();

        if(!$article) {
            return response()->json(['status' => '404', 'message' => 'NOT FOUND.'], 404);
        }

        return response()->json(['status' => '200' , 'message' => 'RETRIEVE', 'data' => $article]);
    }

    public function getArticles(Request $request) {
        $articles = Article::all();
        $data = [];
        foreach($articles as $art) {
            $title = ucwords($art->title);
            $type = $art->type . 's';
            $newArt = [
                'title' => "<a href='/$type/$art->slug' class='font-medium hover:text-blue-500'>$title</a>",
                'status' => $art->status,
                'type' => $art->type,
                'detail' => "<button type='submit' data-slug='$art->slug' data-url='/admin/articles/getArticle/$art->slug' class='view-detail-article shadow-lg bg-blue-500 hover:bg-blue-600 text-white p-1 rounded'><i class<i class='fa-solid fa-circle-info'></i></button>"
            ];

            array_push($data, $newArt);
        }

        return response()->json(['status' => 'Success', 'message' => 'GET_SUCCESS', 'data' => $data]);
    }

    public function createArticle(Request $request) {
        $this->data['title'] = 'Create Article';

        return view('admin.partials.articles.create', [
            'datas' => $this->data
        ]);

    }

    public function storeArticle(StoreArticleRequest $request) {

        DB::beginTransaction();
        try{
            if($request->hasFile('images')){
                $filename = FileUploadService::storeArticleImage($request->file('images'));
            }

            $result = Article::create([
                'slug' => Str::slug(strtolower($request->title)),
                'title' => strtolower($request->title),
                'description' => strtolower(($request->description)),
                'body' => $request->body,
                'type' => $request->type,
                'images' => $filename ?? null,
            ]);

            if($result) {
                DB::commit();
                Log::create([
                    'type' => 'create',
                    'remark' => 'Create ' . $request->type . ' ' . strtolower($request->title)
                ]);
                return redirect('/admin/articles/create')->with('store-article-message', $request->type . ' has been saved.');
            }

            DB::rollBack();
            return back()->with('store-article-error', 'Store Article error.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('store-article-error', 'Store Article failed.');
        }
    }

    public function updateArticle(Request $request, $slug) {
        $article = Article::where('slug', $slug)->first();

        $validator = $request->validate([
            'images' => ['image'],
            'title' => ['required', 'min:5', 'max:255', 'unique:articles,title,' . $article->id],
            'description' => ['required', 'min:5', 'max:255'],
            'body' => ['required'],
        ]);

        DB::beginTransaction();
        try{
            $article->update([
                'slug' => Str::slug(strtolower($validator['title'])),
                'title' => strtolower($validator['title']),
                'description' => strtolower($validator['description']),
                'body' => $request->body,
            ]);

            if($request->hasFile('images')) {
                if($article->images != NULL) {
                    Storage::delete('public/' . $article->images);
                }

                $filename = FileUploadService::storeArticleImage($request->file('images'));

                if($filename) {
                    $article->update([
                        'images' => $filename
                    ]);
                }
            }

            DB::commit();
            Log::create([
                'type' => 'update',
                'remark' => 'Update ' . $article->type . ' ' . strtolower($article->title)
            ]);
            return response()->json(['status' => 'Success', 'message' => 'UPDATED.'],204);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => '400', 'message' => 'FAILED.'], 400);
        }

        // return response()->json(['status' => '500', 'message' => 'FAILED'], 500);
    }

    public function updateStatusArticle(Request $request, $slug, $status) {
        $article = Article::where('slug', $slug)->first();

        if(!in_array($status, ['draft', 'publish'])){
            return response()->json(['status' => '404', 'message' => 'BAD REQUEST', 'data' => 'STATUS DOES NOT EXIST.']);
        }

        DB::beginTransaction();
        try{
            if($article->status == $status) {
                DB::commit();
                return response()->json(['status' => '200', 'message' => 'Status Same, Nothing change.'], 200);
            }

            $article->update([
                'status' => $status,
            ]);

            DB::commit();
            Log::create([
                'type' => 'update',
                'remark' => 'Update status ' . $article->type . ' to ' . $status . ' ' . strtolower($article->title)
            ]);
            return response()->json(['status' => '204', 'message' => 'UPDATED.'], 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['staus' => '500', 'message' => 'FAILED'], 500);
        }
    }

    public function updateTypeArticle(Request $request, $slug, $type) {
        $article = Article::where('slug', $slug)->first();

        if(!in_array($type, ['article', 'project'])){
            return response()->json(['status' => '404', 'message' => 'BAD REQUEST', 'data' => 'TYPE DOES NOT EXIST.']);
        }

        DB::beginTransaction();
        try{
            if($article->type == $type) {
                DB::commit();
                return response()->json(['status' => '200', 'message' => 'Type Same, Nothing change.'], 200);
            }

            $article->update([
                'type' => $type,
            ]);

            DB::commit();
            Log::create([
                'type' => 'update',
                'remark' => 'Update type ' . $article->type . ' ' . strtolower($article->title)
            ]);
            return response()->json(['status' => '204', 'message' => 'UPDATED.'], 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['staus' => '500', 'message' => 'FAILED'], 500);
        }
    }

    public function deleteArticle(Request $request, $slug) {
        $article = Article::where('slug', $slug)->first();
        if(!$article) {
            return back()->with('session-article-error', 'Article Not Found');
        }

        DB::beginTransaction();
        try {
            if($article->images != '' || $article->images != NULL ){
                Storage::delete('public/' . $article->images);
            }

            $type = $article->type;
            $title = strtolower($article->title);
            $article->delete();

            DB::commit();
            Log::create([
                'type' => 'delete',
                'remark' => 'Delete ' . $type . ' ' . strtolower($title)
            ]);
            return redirect('/admin/articles')->with('session-article-message', 'Article Success Delete.');
        } catch(\Exception $e) {
            DB::rollback();
            return back()->with('session-article-error', 'Failed to delete Article');
        }
    }
}
