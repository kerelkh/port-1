<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReferralRequest;
use App\Http\Requests\StoreSupportRequest;
use App\Models\Log;
use App\Models\PortraitBanner;
use App\Models\Referral;
use App\Models\SquareBanner;
use App\Models\Support;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContentController extends Controller
{
    protected $data = [];

    public function index() {
        $data['title'] = 'Content Management';
        $data['portrait'] = PortraitBanner::all();
        $data['square'] = SquareBanner::all();
        return view('admin.content', [
            'datas' => $data,
        ]);
    }

    public function getSupports() {
        $supports = Support::all();
        $data = [];
        foreach($supports as $sp) {
            $new = [
                'name' => $sp->name,
                'url' => $sp->url,
                'edit' => "<button data-support='$sp->id' class='support-delete-btn bg-white text-red-400 shadow-lg rounded p-1'><i class='fa-solid fa-trash'></i></button>"
            ];
            array_push($data, $new);
        }
        return response()->json(['status' => '200', 'message' => 'success', 'data' => $data]);
    }

    public function storeSupport(StoreSupportRequest $request) {

        DB::beginTransaction();
        try{
            $result = Support::create([
                'name' => $request->support_name,
                'url' => $request->support_url,
            ]);

            if($result) {
                DB::commit();
                Log::create([
                    'type' => 'create',
                    'remark' => 'Create Support ' . $request->support_name
                ]);
                return response()->json(['status' => 'Success', 'message' => 'Created'], 201);
            }

            return response()->json(['status' => '500', 'message' => 'Error'], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => '500', 'message' => 'Error, please contact administrator.'] ,500);
        }

    }

    public function deleteSupport(Request $request, $id) {
        $support = Support::where('id', $id)->first();

        if(!$support){
            return response()->json(['status' => '404', 'message' => 'BAD_REQUEST'], 404);
        }
        $name = $support->name;
        $support->delete();
        Log::create([
            'type' => 'delete',
            'remark' => 'Delete Support ' . $name
        ]);
        return response()->json(['status' => '204', 'message' => 'DELETED'], 204);
    }

    public function getReferrals() {
        $referrals = Referral::all();
        $data = [];
        foreach($referrals as $rf) {
            $new = [
                'name' => $rf->name,
                'url' => $rf->url,
                'edit' => "<button data-referral='$rf->id' class='referral-delete-btn bg-white text-red-400 shadow-lg rounded p-1'><i class='fa-solid fa-trash'></i></button>"
            ];
            array_push($data, $new);
        }
        return response()->json(['status' => '200', 'message' => 'success', 'data' => $data]);
    }

    public function deleteReferral(Request $request, $id) {
        $referral = Referral::where('id', $id)->first();

        if(!$referral){
            return response()->json(['status' => '404', 'message' => 'BAD_REQUEST'], 404);
        }
        $name = $referral->name;
        $referral->delete();
        Log::create([
            'type' => 'delete',
            'remark' => 'Delete Referral ' . $name
        ]);
        return response()->json(['status' => '204', 'message' => 'DELETED'], 204);
    }

    public function storeReferral(StoreReferralRequest $request) {
        DB::beginTransaction();
        try{
            $result = Referral::create([
                'name' => $request->referral_name,
                'url' => $request->referral_url,
            ]);

            if($result) {
                DB::commit();
                Log::create([
                    'type' => 'create',
                    'remark' => 'Create Referral ' . $request->referral_name
                ]);
                return response()->json(['status' => 'Success', 'message' => 'Created'], 201);
            }

            return response()->json(['status' => '500', 'message' => 'Error'], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => '500', 'message' => 'Error, please contact administrator.'] ,500);
        }
    }

    public function updatePortrait(Request $request, $id) {
        $portrait = PortraitBanner::where('id', $id)->first();

        if($request->hasFile('banner')){
            Storage::delete('public/' . $portrait->images);
            $filename = FileUploadService::storePortrait($request->file('banner'));

            $result = $portrait->update([
                'images' => $filename,
            ]);
        }

        Log::create([
            'type' => 'update',
            'remark' => 'Update Portrait ' . $id
        ]);

        return redirect('/content')->with('update-banner-message', 'Portrait banner ' . $id . ' has been updated.');
    }

    public function updateSquare(Request $request, $id) {
        $Square = SquareBanner::where('id', $id)->first();

        if($request->hasFile('banner')){
            Storage::delete('public/' . $Square->images);
            $filename = FileUploadService::storeSquare($request->file('banner'));

            $result = $Square->update([
                'images' => $filename,
            ]);

            Log::create([
                'type' => 'update',
                'remark' => 'Update Square ' . $id
            ]);

            return redirect('/content')->with('update-banner-square-message', 'Square banner ' . $id . ' has been updated.');
        }

        return back()->with('update-banner-square-error', 'Square banner update failed');

    }
}
