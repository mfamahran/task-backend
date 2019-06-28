<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductApiController extends Controller
{
    public function getProducts(){
    	return Product::all();
    }
}
