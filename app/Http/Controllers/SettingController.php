<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Utility;
use App\Services\FileUploadService;
use Dflydev\DotAccessData\Util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    protected $data = [];
    public function index(Request $request) {
        $data['title'] = 'Setting';
        $data['landing-banner'] = Utility::where('name', 'landing-banner')->first();
        return view('admin.setting', [
            'datas' => $data,
        ]);
    }

    public function updateProfile(Request $request) {

        if(Hash::check($request->password, Auth::user()->password)){

            if($request->username == Auth::user()->username &&
            $request->name == Auth::user()->name &&
            $request->email == Auth::user()->email){
                return back()->with('update-profile-error', 'Your input same, nothing change');
            }

            $user = User::where('id', Auth::user()->id)->update([
                'username' => strtolower($request->username),
                'name' => strtolower($request->name),
                'email' => strtolower($request->email)
            ]);

            if($user){
                return redirect('/setting')->with('update-profile-message', 'Profile Update success.');
            }
        }
        return back()->with('update-profile-error', 'Password Incorrect');

    }

    public function updateBanner(Request $request) {
        if($request->hasFile('banner')){
            $landingBanner = Utility::where('name', 'landing-banner')->first();
            if($landingBanner) {
                Storage::delete('public/' . $landingBanner->value);
                $filename = FileUploadService::storeLanding($request->file('banner'));
                $result = $landingBanner->update([
                    'value' => $filename
                ]);
            }else{
                $filename = FileUploadService::storeLanding($request->file('banner'));
                $result = $landingBanner->create([
                    'value' => $filename
                ]);
            }

            if($result) {
                return redirect('/setting')->with('update-banner-message', 'Update Landing Banner Success.');
            }

            return back()->with('update-banner-error', 'Update landing banner failed.');
        }

        return back()->with('update-banner-error', 'Fill the input banner, Nothing change');
    }
}
