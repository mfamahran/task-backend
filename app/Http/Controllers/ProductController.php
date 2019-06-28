<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    public function index(Product $model){
    	return view('product.index', ['products' => $model->all()]);
    }

    public function create(){
    	$categories = Category::all();
    	return view('product.create', ['categories' => $categories]); 
    }

    public function store(ProductRequest $request, Product $model){
        $requestAll = $request->all();
        $requestAll['image_url'] = 'http://localhost:8000/'.$request->image_url->store('public/images/products');
        $requestAll['google_product_category'] = Category::getGoogleProduct(Category::find($request->category_id));
    	$model->create($requestAll);

        return redirect()->route('product.index')->withStatus(__('Product successfully added.')); 
    }
}
