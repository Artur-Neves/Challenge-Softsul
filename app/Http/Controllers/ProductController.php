<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Produto",
 *     description="Representa um pedido/produto",
 *     required={"id","user_name","order_date","delivery_date","status","created_at","updated_at"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_name", type="string", maxLength=255, example="Artur Neves"),
 *     @OA\Property(
 *         property="order_date",
 *         type="string",
 *         format="date-time",
 *         example="01/05/2025 12:12:12",
 *         description="Data e hora do pedido"
 *     ),
 *     @OA\Property(
 *         property="delivery_date",
 *         type="string",
 *         format="date-time",
 *         example="01/10/2025 10:30:00",
 *         description="Data e hora da entrega"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         enum={"pendente","entregue","cancelado"},
 *         example="pendente",
 *         description="Status do pedido"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-05 12:15:00"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-06 08:00:00"
 *     )
 * )

 * @OA\Schema(
 *     schema="ProductRequest",
 *     type="object",
 *     title="Requisição de Produto",
 *     description="Dados necessários para criar ou atualizar um produto",
 *     required={"user_name","order_date","delivery_date","status"},
 *     @OA\Property(property="user_name", type="string", maxLength=255, example="Artur Neves"),
 *     @OA\Property(
 *         property="order_date",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-05 12:12:12",
 *         description="Formato obrigatório: Y-m-d H:i:s"
 *     ),
 *     @OA\Property(
 *         property="delivery_date",
 *         type="string",
 *         format="date-time",
 *         example="2025-01-10 15:30:00",
 *         description="Deve ser posterior a 'order_date'"
 *     ),
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         enum={"pendente","entregue","cancelado"},
 *         example="pendente"
 *     )
 * )
 */

class ProductController extends Controller
{

    public function index()
    {
        return view('products.index', [
            'products' => Product::all(),
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     summary="Exibir um produto pelo ID",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do produto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto encontrado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function show(Product $product)
    {
        return $this->response->setData($product)->setStatusCode(200);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     summary="Cadastrar um novo produto",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produto criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação"
     *     )
     * )
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return $this->response->setData($product)->setStatusCode(201);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     summary="Atualizar um produto existente",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do produto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function update(Product $product, ProductRequest $request)
    {
        $product->update($request->validated());

        return $this->response->setData($product)->setStatusCode(200);
    }

     /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     summary="Excluir um produto",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do produto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Produto excluído com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return $this->response->setStatusCode(204);
    }
}