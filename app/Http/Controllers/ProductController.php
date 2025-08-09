<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('products.index', [
            'products' => Product::all(),
        ]);
    }

    public function show(Product $product)
    {
        return $this->response->setData($product)->setStatusCode(200);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return $this->response->setData($product)->setStatusCode(201);
    }

    public function update(Product $product, ProductRequest $request)
    {
        $product->update($request->validated());

        return $this->response->setData($product)->setStatusCode(200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return $this->response->setStatusCode(204);
    }

}