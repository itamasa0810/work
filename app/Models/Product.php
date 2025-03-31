<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    
    //全件取得
    public function getList() {
        $products = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->get();
        return $products;
    }
    //一件取得
    public function getListByid($id) {
        $product = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name')
            ->where('products.id' ,'=', $id)
            ->first();
        return $product;
    }
    //検索
    public function getListBySearch($keyword,$company_id) {
        $products = DB::table('products')
            ->join('companies', 'products.company_id', '=', 'companies.id')
            ->select('products.*', 'companies.company_name');
            
            if (!empty($keyword)) {
                $products->where('product_name', 'like', "%{$keyword}%");
            }
            if (!empty($company_id)) {
                $products->where('products.company_id', $company_id);
            }
        return $products->get();
    }

    
}
