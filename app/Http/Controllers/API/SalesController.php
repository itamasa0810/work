<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class SalesController extends Controller
{
    public function buy($id,$orders){
        try {
            $sale = new Sale();
            $sale->product_id = $id;
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['status' => 'error', 'message' => '商品が見つかりません']);
            }
            if($orders > 0 &&$product -> stock >= $orders) {
                $product -> stock = $product -> stock - $orders;
                $sale -> save();
                $product -> save();
                return response()->json(['status' => 'ok']);
            } else {
                return response()->json(['status' => 'error', 'message' => '商品が見つかりません']);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => '処理に問題が発生しました']);
        }

    }
}
