<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $data =[];

    public function index(Request $request) {
        $this->data['title'] = "Product's";
        $this->data['desc'] = 'See all of my products.';
        if($request->query('search') == '' || $request->query('search') == NULL){
            $this->data['products'] = Product::all();
        }else{
            $this->data['products'] = Product::where('name', 'LIKE', '%' . $request->query('search') . '%')->orderBy('created_at', 'desc')->get();
        }

        return view('product', [
            'datas' => $this->data,
        ]);
    }

    public function getProduct(Request $request, $slug) {
        $this->data['product'] = Product::where('slug', $slug)->first();
        if($this->data['product']->count() <= 0) {
            return back()->with('session-error', 'data not found.');
        }
        $this->data['title'] = ucwords($this->data['product']->name);
        $this->data['products'] = Product::whereNot('slug', $slug)->inRandomOrder()->limit(5)->get();
        return view('show-product', [
            'datas' => $this->data
        ]);
    }
}
