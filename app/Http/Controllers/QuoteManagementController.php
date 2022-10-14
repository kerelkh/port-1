<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class QuoteManagementController extends Controller
{
    public function index(Request $request) {
        $this->data['title'] = 'Quote Management';

        return view('admin.quote', [
            'datas' => $this->data
        ]);
    }

    public function storeQuote(Request $request) {
        $validator = $request->validate([
            'quote_quote' => ['required', 'min:3', 'max:255', 'unique:quotes,quote'],
            'quote_name' => ['required', 'min:3', 'max:50'],
        ]);

        DB::beginTransaction();
        try{
            $result = Quote::create([
                'quote' => strtolower($validator['quote_quote']),
                'name' => strtolower($validator['quote_name']),
            ]);

            if($result) {
                DB::commit();
                return response()->json(['status' => 'Success', 'message' => 'CREATED.', 'data' => 'Quote create successfully.'], 201);
            }

            DB::rollBack();
            return response()->json(['status' => 'Error', 'message' => 'ERROR', 'data' => 'Failed Created Quote.'], 500);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'Error', 'message' => 'ERROR'], 500);
        }
    }
    public function getQuote(Request $request) {
        $quotes = Quote::all();
        $data = [];
        foreach($quotes as $qt) {
            $newQt = [
                'name' => $qt->name,
                'quote' => $qt->quote,
                'delete' => "<button data-quote='$qt->id' class='delete-quote-btn p-1 rounded bg-white text-red-600'><i class='fa-solid fa-trash'></i></button>"
            ];

            array_push($data, $newQt);
        }

        return response()->json(['status' => 'Success', 'message' => 'GET_SUCCESS', 'data' => $data]);
    }

    public function deleteQuote(Request $request, $id) {
        $quote = Quote::where('id', $id)->first();

        if(!$quote){
            return response()->json(['status' => '404', 'message' => 'NOT FOUND'], 404);
        }

        DB::beginTransaction();
        try{
            $result = $quote->delete();

            if($result) {
                DB::commit();
                return response()->json(['status' => '204', 'message' => 'DELETED.'], 204);
            }

            DB::rollBack();
            return response()->json(['status' => '500', 'message' => 'Error'], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => '500', 'message' => 'Error ' . $e], 500);
        }
    }
}
