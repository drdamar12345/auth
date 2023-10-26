<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;

class ProductController extends BaseController
{
    public function produk()
    {
        $product = Product::all();
        return $this->sendResponse($product, 'Products retrieved successfully.');
    }
}
