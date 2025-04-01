<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\User;
use App\Models\Product;
use App\Models\Company;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //一覧
    public function list() {
        $product = new Product();
        $products = $product -> getList();
        $company = new Company();
        $companies = $company -> getList();
        return view('list', ['products' => $products, 'companies' => $companies]);
    }

    public function create() {
        $company = new Company();
        $companies = $company -> getList();
        return view('create', ['companies' => $companies]);
    }
    //新規
    public function add(ArticleRequest $request) {
        try {
            $product = new Product();
            $product -> company_id = $request -> company_id;
            $product -> product_name = $request -> name;
            $product -> price = $request -> price;
            $product -> stock = $request -> stock;
            $product -> comment = $request -> comment;
            if ($request -> hasFile('img')) {
                $img = $request -> file('img');
                $img_name = $img->getClientOriginalName();
                $img->storeAs('public/images', $img_name);
                $img_path = 'storage/images/' . $img_name;
                $product -> img_path = $img_path;
            }else {
                $product -> img_path = null;
            }
            $product -> save();
            return redirect() -> route('list');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back();
        } 
    }
    //詳細
    public function info($id) {
        $products = new Product();
        $product = $products -> getListByid($id);
        return view('info', ['product' => $product]);
    }
    //更新
    public function edit($id) {
        $products = new Product();
        $product = $products -> getListByid($id);
        $company = new Company();
        $companies = $company -> getList();
        return view('edit', ['product' => $product, 'companies' => $companies]);
    }

    public function update(ArticleRequest $request) {
        try {
            $product = Product::find($request->id);
            $product -> company_id = $request -> company_id;
            $product -> product_name = $request -> name;
            $product -> price = $request -> price;
            $product -> stock = $request -> stock;
            $product -> comment = $request -> comment;
            if ($request -> hasFile('img')) {
                $img = $request -> file('img');
                $img_name = $img->getClientOriginalName();
                $img->storeAs('public/images', $img_name);
                $img_path = 'storage/images/' . $img_name;
                $product -> img_path = $img_path;
            }else {
                $product -> img_path = null;
            }
            $product -> save();
            return redirect()->route('list');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back();
        }

    }
    //削除
    public function delete($id) {
        try {
            $product = Product::find($id);
            $product ->delete();
            return redirect()->route('list');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
    //検索
    public function search(Request $request) {
        try {
            $keyword = $request->keyword ?? '';
            $company_id = $request -> company_id ?? '';
    
            $product = new Product();
            $products = $product -> getListBySearch($keyword,$company_id);
    
            $company = new Company();
            $companies = $company -> getList();
    
            return view('list', ['products' => $products, 'companies' => $companies]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return back();
        }
    }
}
