<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    protected $guarded = ['id'];
    public function index(Request $request) {
        $this->data['title'] = "Gallery";
        $this->data['desc'] = 'A moment lasts all of a second, but the memory lives on forever.';
        $this->data['galleries'] = Photo::orderBy('created_at', 'desc')->get();

        return view('photo', [
            'datas' => $this->data
        ]);
    }
}
