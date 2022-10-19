<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class GalleryManagementController extends Controller
{
    protected $data = [];
    public function index(Request $request) {
        $this->data['title'] = 'Gallery Management';

        return view('admin.gallery', [
            'datas' => $this->data,
        ]);
    }

    public function getGalleries(Request $request) {
        $galleries = Photo::all();
        $data = [];

        foreach($galleries as $gly) {
            $newData = [
                'name' => $gly->name,
                'date' => $gly->created_at->format('d-m-Y'),
                'Detail' => "<button data-photo='$gly->id' class='view-photo-detail text-lg text-blue-600'><i class='fa-solid fa-circle-info'></i></button>",
            ];

            array_push($data, $newData);
        }

        return response()->json(['status' => 'Success', 'message' => 'SUCCESS.', 'data' => $data]);
    }

    public function getGallery(Request $request, $id) {
        $gallery = Photo::whereId($id)->first();

        if(!$gallery->count() > 0) {
            return response()->json(['status' => '404', 'message' => 'NOT FOUND.', 'data' => 'Data not Found.']);
        }

        return response()->json(['status' => '200', 'message' => 'GET SUCCESS', 'data' => $gallery]);
    }

    public function storeGallery(Request $request) {
        $validator = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:photos,name'],
            'image' => ['required', 'image']
        ]);

        DB::beginTransaction();
        try{
            $filename = FileUploadService::storePhotoImage($request->file('image'));
            $result = Photo::create([
                'name' => $validator['name'],
                'images' => $filename,
            ]);

            if($result) {
                DB::commit();
                return redirect('/admin/gallery')->with('store-photo-message', 'Photo has been uploaded.');
            }

            DB::rollBack();
            return back()->with('store-photo-error', 'Failed store photo');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('store-photo-error', 'Failed store photo.');
        }
    }

    public function updateGallery(Request $request, $id) {
        $validator = $request->validate([
            'update-photo_name' => ['required', 'min:3', 'max:255'],
            'image-update' => ['image']
        ]);

        $photo = Photo::whereId($id)->first();

        DB::beginTransaction();
        try{
            $filename = '';
            if($request->hasFile('image-update')){
                Storage::delete('public/' . $photo->images);
                $filename = FileUploadService::storePhotoImage($request->file('image-update'));
            }

            $result = $photo->update([
                'name' => $validator['update-photo_name'],
                'images' => ($filename != '' || $filename != 0) ? $filename : $photo->images,
            ]);

            if($result) {
                DB::commit();
                return redirect("/admin/gallery")->with('update-photo-message', 'Update Photo Success');
            }

            DB::rollBack();
            return back()->with('update-photo-error', 'Update Photo Failed.');
        }catch (\Exception $e) {
            DB::rollBack();
            return back()->with('update-photo-error', 'Update photo failed.');
        }
    }

    public function deleteGallery(Request $request, $id) {
        $photo = Photo::whereId($id)->first();

        DB::beginTransaction();
        try{
            Storage::delete('public/' . $photo->images);
            $photo->delete();

            DB::commit();
            return redirect('/admin/gallery')->with('session-gallery-message', 'Success Delete Photo');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('session-gallery-error', 'Failed delete photo');
        }
    }
}
