<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Log;
use App\Models\Product;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    protected $data = [];

    public function index(Request $request) {
        $this->data['title'] = 'Product Management';

        return view('admin.products', [
            'datas' => $this->data,
        ]);
    }

    public function getProduct(Request $request, $slug) {
        $product = Product::where('slug', $slug)->first();

        if(!$product) {
            return response()->json([
                'status' => 404,
                'message' => 'NOT FOUND',
                'data' => 'Data product not Found.'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'RETRIEVE',
            'data' => $product
        ]);
    }

    public function getProducts(Request $request) {
        $products = Product::all();
        $this->data['products'] = [];
        foreach($products as $pr) {
            $newPr = [
                'slug' => $pr->slug,
                'name' => $pr->name,
                'price' => 'Rp' . $pr->price,
                'stock' => $pr->stock,
                'detail' => "<button data-slug='$pr->slug' data-url='/admin/products/get-product/$pr->slug' class='view-detail-product p-1 text-blue-600 text-lg'><i class='fa-solid fa-circle-info'></i></button>"
            ];

            array_push($this->data['products'], $newPr);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'DATA RETRIEVE',
            'data' => $this->data['products']
        ]);
    }

    public function createProduct(Request $request) {
        $this->data['title'] = 'Create Product';

        return view('admin.partials.product.create', [
            'datas' => $this->data
        ]);
    }

    public function storeProduct(StoreProductRequest $request) {
        DB::beginTransaction();
        try{
            $filename = FileUploadService::storeProductImage($request->file('images'));

            if($filename) {
                $result = Product::create([
                    'slug' => Str::slug(strtolower($request->name)),
                    'name' => strtolower($request->name),
                    'price' => $request->price,
                    'unit' => $request->unit,
                    'stock' => $request->stock,
                    'description'  => $request->body,
                    'images' => $filename,
                ]);

                if($result) {
                    DB::commit();
                    Log::create([
                        'type' => 'create',
                        'remark' => 'Create Product' . strtolower($request->name),
                    ]);
                    return back()->with('store-product-message', 'Product has been created.');
                }
            }

            DB::rollBack();
            return back()->with('store-product-error', 'Failed to store product.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('store-product-error', 'Failed store product.');
        }
    }

    public function updateProduct(Request $request, $slug) {
        $product = Product::where('slug', $slug)->first();

        $validator = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:products,name,' . $product->id],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'unit' => ['required', 'alpha'],
            'body' => ['required'],
        ]);

        DB::beginTransaction();
        try{
            $product->slug = Str::slug(strtolower($validator['name']));
            $product->name = strtolower($validator['name']);
            $product->stock = $validator['stock'];
            $product->unit = $validator['unit'];
            $product->description = $validator['body'];

            $product->save();

            DB::commit();
            Log::create([
                'type' => 'update',
                'remark' => 'Update Product ' . $product->name,
            ]);
            return response()->json(['status' => '204', 'message' => 'SUCCESS.', 'data' => 'Update Success.'], 204);

        }catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => '500',
                'message' => 'Failed.',
                'data' => $e,
            ], 500);
        }
    }

    public function updateImageProduct(Request $request, $slug) {
        $product = Product::where('slug', $slug)->first();

        DB::beginTransaction();
        try{
            if($product->images != NULL || $product->images != "") {
                Storage::delete('public/' . $product->images);
            }

            $filename = FileUploadService::storeProductImage($request->file('images'));
            if($filename) {
                $product->images = $filename;
                $product->save();

                DB::commit();
                Log::create([
                    'type' => 'update',
                    'remark' => 'Update Image Product ' . $product->name,
                ]);
                return redirect('/admin/products')->with('update-image-product-message', 'Update Image Success.');
            }

            DB::rollBack();
            return back()->with('update-image-product-error', 'Update Image Failed.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('update-image-product-error', 'Failed to update image');
        }
    }

    public function deleteProduct(Request $request, $slug) {
        $product = Product::where('slug', $slug)->first();

        if(!$product) {
            return back()->with('session-product-error', 'Product Not Found.');
        }

        DB::beginTransaction();
        try{
            if($product->images) {
                Storage::delete('public/' . $product->images);
            }

            $nameProduct = $product->name;
            $result = $product->delete();
            if($result) {
                DB::commit();
                Log::create([
                    'type' => 'delete',
                    'remark' => 'Delete Product ' . $nameProduct
                ]);
                return redirect('/admin/products')->with('session-product-message', 'Product Deleted.');
            }

            DB::rollBack();
            return back()->with('session-product-error', 'Product Failed to delete.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('session-product-error', 'Product Failed to delete.');
        }
    }
}
