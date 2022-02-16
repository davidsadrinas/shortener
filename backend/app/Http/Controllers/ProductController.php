<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $productService;

    public function __construct(IProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(ProductRequest $request) {

    }
}
