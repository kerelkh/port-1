<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Message;
use App\Models\Photo;
use App\Models\PortraitBanner;
use App\Models\Referral;
use App\Models\SquareBanner;
use App\Models\Support;
use App\Models\Utility;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $data = [];

    public function index(Request $request) {
        $data['landing-banner'] = Utility::where('name', 'landing-banner')->first();
        $data['landing-title'] = Utility::where('name', 'landing-title')->first();
        $data['landing-desc'] = Utility::where('name', 'landing-desc')->first();
        $data['supports'] = Support::all();
        $data['referrals'] = Referral::all();
        $data['galleries'] = Photo::limit(6)->get();
        $data['portraitBanners'] = PortraitBanner::all();
        $data['squareBanners'] = SquareBanner::all();
        $data['articles'] = Article::where('type', 'article')->where('status', 'publish')->limit(3)->orderBy('created_at', 'desc')->get();

        return view('home', [
            'datas' => $data,
        ]);
    }

    public function sendMessage(Request $request) {
        $validator = $request->validate([
            'email' => ['required','email'],
            'message' => ['required', 'min:3', 'max:255']
        ]);
        $result = Message::create([
            'email' => strtolower($validator['email']),
            'message' => ucwords($validator['message'])
        ]);

        return redirect('/')->with('send-message', 'Send Message Success.');
    }
}
