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


    public function findById(Product $product)
    {
        return $this->response->setData($product)->setStatusCode(200);
    }

    public function save(ProductRequest $request)
    {
        $product = Product::create($request->all());

        return $this->response->setData($product)->setStatusCode(201);
    }

    public function update(Product $product, ProductRequest $request)
    {
        $product->update($request->all());

        return $this->response->setData($product)->setStatusCode(200);
    }

    public function delete(Product $product)
    {
       $product->delete();

        return $this->response->setStatusCode(204);
    }

}